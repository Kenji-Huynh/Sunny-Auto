<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng số sản phẩm (không tính soft deleted)
        $totalProducts = Product::count();

        // Tổng số blog (không tính soft deleted)
        $totalBlogs = BlogPost::count();

        // Tổng số lần liên hệ
        $totalContacts = Contact::count();

        return view('dashboard', compact(
            'totalProducts',
            'totalBlogs', 
            'totalContacts'
        ));
    }
}
