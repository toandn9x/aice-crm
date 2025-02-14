<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login'); // View sẽ nằm trong thư mục resources/views/admin/auth
    }

    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $credentials = $request->validate([
            'username'    => 'required', // Có thể là email hoặc username
            'password' => 'required',
        ], [
            'username.required'    => 'Tên đăng nhập không được để trống.',
            'password.required' => 'Mật khẩu không được để trống.',
        ]);

        // Xác định login theo email hoặc username
        $loginField = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Kiểm tra đăng nhập
        if (Auth::attempt([$loginField => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu sai, quay lại với thông báo lỗi
        return back()->withErrors(['login' => 'Tên đăng nhập hoặc mật khẩu không chính xác.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công!');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register'); // View sẽ nằm trong thư mục resources/views/admin/auth
    }

    public function register(Request $request)
    {

    }
}
