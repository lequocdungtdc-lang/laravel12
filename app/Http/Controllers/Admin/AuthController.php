<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            if (Auth::user()->role != 'admin') {
                Auth::logout();
                return back()->with('error', 'Không có quyền admin');
            }

            return redirect('/admin');
        }

        return back()->with('error', 'Sai email hoặc password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}