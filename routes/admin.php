<?php
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->group(function () {

    // login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    // logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    // 👇 BẮT BUỘC phải có middleware
    Route::middleware('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        });
        Route::get('/users', [UserController::class, 'index']);
    });

});