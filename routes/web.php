<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MemberController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/member/register', [MemberController::class, 'register'])->name('member.register');
Route::post('/member/register', [MemberController::class, 'store'])->name('member.register.post');
Route::get('/member/login', [MemberController::class, 'showLogin'])->name('member.login');
Route::post('/member/login', [MemberController::class, 'login'])->name('member.login.post');
Route::get('/member/logout', [MemberController::class, 'logout'])->name('member.logout');



// Route::get('/', function () {
//     return view('welcome');
// });
