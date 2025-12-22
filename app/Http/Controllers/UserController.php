<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);

        // Statistics
        $adminCount = User::count(); // Tất cả user đều là admin
        $userCount = 0; // Không còn phân biệt user thường
        $recentCount = User::whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year)
                          ->count();

        return view('users.index', compact('users', 'adminCount', 'userCount', 'recentCount'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        // Tài khoản tạo từ admin panel luôn có role là admin
        $validated['role'] = 'admin';

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Tài khoản Admin đã được tạo thành công!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        // Luôn set role = admin
        $validated['role'] = 'admin';

        // Only update password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.show', $user)
            ->with('success', 'Tài khoản đã được cập nhật thành công!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Bạn không thể xóa tài khoản của chính mình!');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Tài khoản đã được xóa thành công!');
    }

    /**
     * Reset password for the specified user.
     */
    public function resetPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return redirect()->route('users.show', $user)
            ->with('success', 'Mật khẩu đã được đặt lại thành công!');
    }
}
