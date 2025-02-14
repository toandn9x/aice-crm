<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        // Kiểm tra session
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Phiên đăng nhập đã hết hạn!.');
        }
    }
    public function index()
    {
        return view('admin.index');
    }
}
