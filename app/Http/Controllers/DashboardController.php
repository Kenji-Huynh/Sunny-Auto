<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng số sản phẩm
        $totalProducts = DB::table('products')->count();

        // Tổng số blog
        $totalBlogs = DB::table('blog_posts')->count();

        // Tổng số lần liên hệ
        $totalContacts = DB::table('contacts')->count();

        return view('dashboard', compact(
            'totalProducts',
            'totalBlogs', 
            'totalContacts'
        ));
    }
}
