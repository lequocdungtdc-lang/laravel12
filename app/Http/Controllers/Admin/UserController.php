<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function store(Request $r) {
        $data = $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'role'=>'required'
        ]);

        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function update(Request $r, $id) {
        $user = User::findOrFail($id);

        $data = $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'nullable|min:6',
            'role'=>'required'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return ['ok'=>true];
    }
}