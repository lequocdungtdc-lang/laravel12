<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Auth;
use Hash;


class MemberController extends AllController
{
    //index
    public function index()
    {
        return view('web.member.index');
    }

     // register 
    public function register()
    {

        return view('web.member.register');
    }
    // store
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|min:6|confirmed',
        ]);
        // custom validation message
        $request->validate([
            'fullname.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ]);

        // create member
        $member = new Member();
        $member->fullname = $request->fullname;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->save();

        // login
        Auth::guard('member')->login($member);

       return redirect('/');
    }

    //login
    public function showLogin()
    {
        return view('web.member.login');
    }

   public function login(Request $request)
    {
        // validate + message
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        // login
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            return redirect('/');
        }

        // ❌ sai tài khoản hoặc mật khẩu
        return back()
            ->withErrors(['login' => 'Email hoặc mật khẩu không đúng'])
            ->withInput();
    }
    
    //logout
    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect('/');
    }

    //  profile
    public function profile()
    {
        $authUser = Auth::guard('member')->user();
        return view('web.member.profile', compact('authUser'));
    }
    // updateProfile 
    public function updateProfile(Request $request)
    {
        $authUser = Auth::guard('member')->user();

        // validate
        $request->validate([
            'fullname' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255|email|unique:members,email,' . $authUser->id,
            'password' => 'nullable|min:6|confirmed',
            'phone' => ['nullable', 'regex:/^0\d{9}$/'],
            'address' => ['nullable', 'string', 'max:255'],
        ], [
            'fullname.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'phone.regex' => 'Số điện thoại không hợp lệ (bắt đầu bằng 0 và có 10 số)',
            'address.max' => 'Địa chỉ không được quá 255 ký tự',
        ]);

        // update member
        if ($request->filled('fullname')) {
            $authUser->fullname = $request->fullname;
        }
        if ($request->filled('email')) {
            $authUser->email = $request->email;
        }
        if ($request->filled('phone')) {
            $authUser->phone = $request->phone;
        }
        if ($request->filled('address')) {
            $authUser->address = $request->address;
        }

        // xử lý đổi mật khẩu
        if ($request->filled('password')) {
            // bắt buộc nhập mật khẩu cũ
            if (!$request->filled('current_password')) {
                return back()->withErrors([
                    'current_password' => 'Vui lòng nhập mật khẩu cũ'
                ])->withInput();
            }
            // kiểm tra mật khẩu cũ
            if (!Hash::check($request->current_password, $authUser->password)) {
                return back()->withErrors([
                    'current_password' => 'Mật khẩu cũ không đúng'
                ])->withInput();
            }
            // cập nhật mật khẩu mới
            $authUser->password = Hash::make($request->password);
        }

        $authUser->save();

        return back()->with('success', 'Cập nhật thông tin thành công');
    }
}
