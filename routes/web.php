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

Route::prefix('member')
    ->middleware('auth:member')
    ->name('member.')
    ->group(function () {
        Route::get('/profile', [MemberController::class, 'profile'])->name('profile');
        Route::post('/profile', [MemberController::class, 'updateProfile'])->name('profile.update');
    });


// Route::get('/', function () {
//     return view('welcome');
// });
