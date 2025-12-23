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
    // Public API endpoints for products (rate limited)
    Route::get('/products/search', [ProductController::class, 'search'])
        ->middleware('throttle:search'); // 30 req/min
    Route::get('/products', [ProductController::class, 'getAllProducts'])
        ->middleware('throttle:api'); // 60 req/min
    Route::get('/products/featured', [ProductController::class, 'getFeatured'])
        ->middleware('throttle:api');
    Route::get('/products/{slug}', [ProductController::class, 'getProductBySlug'])
        ->middleware('throttle:api');
    Route::get('/categories', [ProductController::class, 'getCategories'])
        ->middleware('throttle:api');
    
    // Public API endpoints for blogs (rate limited)
    Route::get('/blogs', [BlogController::class, 'getBlogs'])
        ->middleware('throttle:api');
    Route::get('/blogs/{slug}', [BlogController::class, 'getBlogBySlug'])
        ->middleware('throttle:api');
    Route::get('/blog-categories', [BlogController::class, 'getCategories'])
        ->middleware('throttle:api');
    
    // Contact form submission (public - rate limited to prevent spam)
    Route::post('/contact', [ContactController::class, 'store'])
        ->middleware('throttle:contact'); // 3 req/min
    Route::post('/contacts', [ContactController::class, 'store'])
        ->middleware('throttle:contact');
});

// Auth routes (with rate limiting to prevent brute force)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:login'); // 5 attempts/min
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:login'); // 5 attempts/min

// Protected admin routes (with higher rate limit)
Route::middleware(['auth', AdminMiddleware::class, 'throttle:admin'])->group(function () {
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

    // ========================================
    // Storage Info Route (CHỈ DÙNG ĐỂ KIỂM TRA)
    // ========================================
    Route::get('/storage-info', function() {
        try {
            $disk = \Illuminate\Support\Facades\Storage::disk('public');
            
            // Get all files
            $allFiles = $disk->allFiles();
            $directories = $disk->allDirectories();
            
            // Calculate total size
            $totalSize = 0;
            foreach ($allFiles as $file) {
                $totalSize += $disk->size($file);
            }
            
            // Get files by directory
            $filesByDir = [];
            foreach ($directories as $dir) {
                $files = $disk->files($dir);
                $filesByDir[$dir] = [
                    'count' => count($files),
                    'files' => array_map(function($file) use ($disk) {
                        return [
                            'name' => basename($file),
                            'path' => $file,
                            'size' => $disk->size($file),
                            'size_human' => $disk->size($file) > 1024*1024 
                                ? round($disk->size($file)/(1024*1024), 2) . ' MB'
                                : round($disk->size($file)/1024, 2) . ' KB',
                            'url' => asset('storage/' . $file),
                            'last_modified' => date('Y-m-d H:i:s', $disk->lastModified($file)),
                        ];
                    }, $files)
                ];
            }
            
            // Check if storage link exists
            $storageLinkExists = is_link(public_path('storage'));
            $storageLinkTarget = $storageLinkExists ? readlink(public_path('storage')) : null;
            
            return response()->json([
                'success' => true,
                'storage_info' => [
                    'disk' => config('filesystems.default'),
                    'public_disk' => 'public',
                    'storage_path' => storage_path('app/public'),
                    'public_path' => public_path('storage'),
                    'link_exists' => $storageLinkExists,
                    'link_target' => $storageLinkTarget,
                ],
                'statistics' => [
                    'total_files' => count($allFiles),
                    'total_directories' => count($directories),
                    'total_size_bytes' => $totalSize,
                    'total_size_human' => $totalSize > 1024*1024*1024 
                        ? round($totalSize/(1024*1024*1024), 2) . ' GB'
                        : ($totalSize > 1024*1024 
                            ? round($totalSize/(1024*1024), 2) . ' MB'
                            : round($totalSize/1024, 2) . ' KB'),
                ],
                'directories' => $directories,
                'files_by_directory' => $filesByDir,
                'all_files' => array_map(function($file) use ($disk) {
                    return [
                        'name' => basename($file),
                        'path' => $file,
                        'size' => $disk->size($file),
                        'size_human' => $disk->size($file) > 1024*1024 
                            ? round($disk->size($file)/(1024*1024), 2) . ' MB'
                            : round($disk->size($file)/1024, 2) . ' KB',
                        'url' => asset('storage/' . $file),
                    ];
                }, $allFiles),
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    })->name('storage.info');
});

// ========================================
// FRONTEND CATCH-ALL ROUTE (ĐẶT CUỐI CÙNG!)
// ========================================
Route::fallback(function () {
    return view('frontend');
});
