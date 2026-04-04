<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MemberController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/member/register', [MemberController::class, 'register'])->name('member.register');
Route::post('/member/register', [MemberController::class, 'store'])->name('store');
Route::get('/member/login', [MemberController::class, 'showLogin'])->name('login');
Route::post('/member/login', [MemberController::class, 'login'])->name('login.post');
Route::get('/member/logout', [MemberController::class, 'logout'])->name('logout');



// Route::get('/', function () {
//     return view('welcome');
// });
