<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\LarkService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    protected $larkService;

    public function __construct(LarkService $larkService)
    {
        $this->larkService = $larkService;
    }
    /**
     * Display a listing of contacts (for admin) with filters
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('company')) {
            $query->where('company', 'like', '%' . $request->company . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(15);

        // Lấy danh sách khu vực duy nhất từ database
        $locations = Contact::query()
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        $unreadCount = Contact::unread()->count();
        $newCount = Contact::new()->count();

        return view('contacts.index', compact('contacts', 'unreadCount', 'newCount', 'locations'));
    }

    /**
     * Export contacts to Excel
     */
    public function export(Request $request)
    {
        $query = Contact::query();

        // Apply same filters as index method
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->get();

        // Create CSV content with new fields
        $csvData = [];
        $csvData[] = [
            'Họ và tên',
            'Công ty',
            'Email',
            'Số điện thoại',
            'Địa điểm',
            'Loại yêu cầu',
            'Mục đích sử dụng',
            'Ngân sách',
            'Thời gian mua',
            'Ghi chú',
            'Ngày tạo'
        ];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->name,
                $contact->company ?: '',
                $contact->email,
                $contact->phone ?: '',
                $contact->location ?: '',
                is_array($contact->inquiry_types) ? implode(', ', $contact->inquiry_types) : '',
                $contact->intended_use ?: '',
                $contact->estimated_budget ?: '',
                $contact->purchase_timeline ?: '',
                $contact->notes ?: '',
                $contact->created_at->format('d/m/Y H:i')
            ];
        }

        // Set headers for download
        $filename = 'contacts_export_' . now()->format('Y_m_d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Create CSV response
        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8 to display Vietnamese characters correctly in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Store a newly created contact from frontend
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'location' => 'nullable|string|max:255',
            'inquiry_types' => 'required|array',
            'ev_products' => 'nullable|array',
            'ev_products_other' => 'nullable|string|max:255',
            'charging_products' => 'nullable|array',
            'charging_products_other' => 'nullable|string|max:255',
            'intended_use' => 'required|string|max:255',
            'intended_use_other' => 'nullable|string|max:255',
            'estimated_budget' => 'nullable|string|max:255',
            'purchase_timeline' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'consent_agreed' => 'required|boolean',
        ]);

        try {
            // Create contact
            $contact = Contact::create($validated);

            // Broadcast event for real-time notification
            event(new \App\Events\NewContactReceived($contact));

            // Send Lark notification (non-blocking)
            try {
                $chatId = env('LARK_CONTACT_GROUP_ID');
                if ($chatId) {
                    // Send interactive card (recommended)
                    $this->larkService->sendCardMessage($chatId, $contact);
                    Log::info("✅ Lark notification sent for contact: {$contact->id}");
                }
            } catch (\Exception $e) {
                // Log but don't fail the main flow
                Log::error("❌ Lark notification failed: " . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.',
                'data' => $contact
            ], 201);

        } catch (\Exception $e) {
            Log::error('Contact creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại sau!'
            ], 500);
        }
    }

    /**
     * Display the specified contact
     */
    public function show(Contact $contact)
    {
        $contact->markAsRead();
        
        return view('contacts.show', compact('contact'));
    }

    /**
     * Update the status of a contact
     */
    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_progress,resolved',
            'admin_notes' => 'nullable|string',
        ]);

        $contact->update($validated);

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    /**
     * Remove the specified contact from storage
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Đã xóa liên hệ thành công!');
    }

    /**
     * Get unread contacts count for notification badge
     */
    public function unreadCount()
    {
        return response()->json([
            'count' => Contact::unread()->count()
        ]);
    }
}
