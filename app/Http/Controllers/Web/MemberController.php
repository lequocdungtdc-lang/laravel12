<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Auth;


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
    //logout
    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect('/');
    }

     // show login form
    //  public function showLogin()
    //  {
    //      return view('web.member.login');
    //  }
}
