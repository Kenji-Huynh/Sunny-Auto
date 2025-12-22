<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;

// ========================================
// API ROUTES (ĐẶT TRƯỚC - QUAN TRỌNG!)
// ========================================
Route::prefix('api')->group(function () {
    // Public API endpoints for products
    Route::get('/products', [ProductController::class, 'getAllProducts']); // All products with filters
    Route::get('/products/featured', [ProductController::class, 'getFeatured']); // Featured products
    Route::get('/products/{slug}', [ProductController::class, 'getProductBySlug']); // Single product by slug
    Route::get('/categories', [ProductController::class, 'getCategories']); // Product categories
    
    // Public API endpoints for blogs
    Route::get('/blogs', [BlogController::class, 'getBlogs']); // Blog list
    Route::get('/blogs/{slug}', [BlogController::class, 'getBlogBySlug']); // Single blog by slug
    Route::get('/blog-categories', [BlogController::class, 'getCategories']); // Blog categories
    
    // Contact form submission (public - KHÔNG CẦN AUTH)
    // Hỗ trợ cả 2 URL: /api/contact và /api/contacts
    Route::post('/contact', [ContactController::class, 'store']);
    Route::post('/contacts', [ContactController::class, 'store']);
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected admin routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::resource('users', UserController::class);
    
    // Product Management
    Route::resource('products', ProductController::class);
    
    // Blog Management
    Route::resource('blogs', BlogController::class);
    
    // Contact Management
    Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');
    Route::resource('contacts', ContactController::class)->except(['create', 'edit']);
    Route::put('/contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.status');
    Route::get('/contacts/unread-count', [ContactController::class, 'unreadCount'])->name('contacts.unread-count');

    // ========================================
    // Lark Bot Test Routes (CHỈ DÙNG ĐỂ TEST)
    // ========================================
    
    Route::get('/test-lark/connection', function() {
        try {
            $larkService = app(\App\Services\LarkService::class);
            $result = $larkService->testConnection();
            
            return response()->json([
                'success' => $result,
                'message' => $result ? '✅ Kết nối Lark thành công!' : '❌ Không thể kết nối Lark',
                'config' => [
                    'app_id' => env('LARK_APP_ID') ? '✅ Configured' : '❌ Missing',
                    'app_secret' => env('LARK_APP_SECRET') ? '✅ Configured' : '❌ Missing',
                    'contact_group_id' => env('LARK_CONTACT_GROUP_ID') ? '✅ Configured' : '❌ Missing',
                ],
                'debug' => [
                    'app_id_value' => substr(env('LARK_APP_ID'), 0, 10) . '...',
                    'base_url' => env('LARK_API_BASE_URL')
                ],
                'timestamp' => now()->toDateTimeString()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '❌ Error: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    })->name('test.lark.connection');

    Route::get('/test-lark/send-message', function() {
        try {
            $larkService = app(\App\Services\LarkService::class);
            $chatId = env('LARK_CONTACT_GROUP_ID');
            
            if (!$chatId) {
                return response()->json([
                    'success' => false,
                    'message' => '❌ LARK_CONTACT_GROUP_ID chưa được cấu hình trong .env'
                ], 400);
            }
            
            $testMessage = "🧪 **TEST MESSAGE**\n\n";
            $testMessage .= "Lark Bot integration is working!\n";
            $testMessage .= "Time: " . now()->format('H:i:s d/m/Y') . "\n";
            $testMessage .= "━━━━━━━━━━━━━━━━━━━━━━";
            
            $result = $larkService->sendMessageToGroup($chatId, $testMessage);
            
            return response()->json([
                'success' => $result,
                'message' => $result ? '✅ Tin nhắn đã gửi thành công! Kiểm tra Lark group.' : '❌ Gửi tin nhắn thất bại. Xem logs.',
                'chat_id' => $chatId,
                'timestamp' => now()->toDateTimeString()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '❌ Error: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    })->name('test.lark.message');

    Route::get('/test-lark/send-card', function() {
        try {
            $larkService = app(\App\Services\LarkService::class);
            $chatId = env('LARK_CONTACT_GROUP_ID');
            
            if (!$chatId) {
                return response()->json([
                    'success' => false,
                    'message' => '❌ LARK_CONTACT_GROUP_ID chưa được cấu hình trong .env'
                ], 400);
            }
            
            // Tạo fake contact để test
            $fakeContact = new \App\Models\Contact([
                'name' => 'Nguyễn Văn Test',
                'email' => 'test@sunnyauto.vn',
                'phone' => '0987654321',
                'subject' => 'Test Lark Card Message',
                'message' => 'Đây là tin nhắn test từ hệ thống Sunny Auto. Nếu bạn thấy card này, nghĩa là Lark Bot integration đã hoạt động thành công! 🎉',
                'status' => 'new',
                'created_at' => now(),
            ]);
            $fakeContact->id = 999;
            
            $result = $larkService->sendCardMessage($chatId, $fakeContact);
            
            return response()->json([
                'success' => $result,
                'message' => $result ? '✅ Card message đã gửi thành công! Kiểm tra Lark group.' : '❌ Gửi card thất bại. Xem logs.',
                'chat_id' => $chatId,
                'contact_preview' => [
                    'name' => $fakeContact->name,
                    'email' => $fakeContact->email,
                    'subject' => $fakeContact->subject
                ],
                'timestamp' => now()->toDateTimeString()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '❌ Error: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    })->name('test.lark.card');
});

// ========================================
// FRONTEND CATCH-ALL ROUTE (ĐẶT CUỐI CÙNG!)
// ========================================
Route::fallback(function () {
    return view('frontend');
});
