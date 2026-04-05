<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::select('*')->orderBy('numb', 'asc')->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function store(Request $r) {
        $id = $r->input('id') ?? 0;
        if($id) {
            $user = User::findOrFail($id);
            $data = $r->validate([
                'fullname'=>'required',
                'email'=>'required|email|unique:users,email,'.$id,
                'password'=>'nullable|min:6|confirmed',
                'role'=>'required',
                'status'=>'required|in:active,inactive,pending',
                'phone'=>'nullable|regex:/^0\d{9}$/',
                'address'=>'nullable|string|max:255'
            ], [
                'fullname.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'role.required' => 'Role không được để trống',
                'status.required' => 'Status không được để trống',
                'status.in' => 'Status phải là active, inactive hoặc pending',
                'phone.regex' => 'Số điện thoại không hợp lệ (bắt đầu bằng 0 và có 10 số)',
                'address.max' => 'Địa chỉ không được quá 255 ký tự',
            ]);

            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
            $user->update($data);
        }else {
           $data = $r->validate([
                'fullname'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|confirmed',
                'role'=>'required',
                'status'=>'required|in:active,inactive,pending',
                'phone'=>'nullable|regex:/^0\d{9}$/',
                'address'=>'nullable|string|max:255'
            ], [
                'fullname.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'role.required' => 'Role không được để trống',
                'status.required' => 'Status không được để trống',
                'status.in' => 'Status phải là active, inactive hoặc pending',
                'phone.regex' => 'Số điện thoại không hợp lệ (bắt đầu bằng 0 và có 10 số)',
                'address.max' => 'Địa chỉ không được quá 255 ký tự',
            ]);

            $data['password'] = bcrypt($data['password']);
        
            User::create($data);
        }
       return redirect()->back()->with('success', 'User created successfully.');
    }

    public function edit(request $r) {
        $id = $r->input('id');
        $user = User::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function destroy($id) {
        if($id) {
           User::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'User not found.');
        }
        
    }
}