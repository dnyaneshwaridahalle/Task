<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin']);

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    // Admin Routes
    Route::middleware(['role:1,2'])->group(function () {
        Route::get('/admin/users/search', [UserManagementController::class, 'index'])
            ->name('admin.users.search')
            ->middleware('check.permission:users,view');

        Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])
            ->name('admin.users.delete')
            ->middleware('check.permission:users,delete');

        Route::get('/admin/user-management', [UserManagementController::class, 'manage'])
            ->name('admin.user.management')
            ->middleware('check.permission:users,view');

        Route::post('user-management/update-permissions', [UserManagementController::class, 'updatePermissions'])
            ->name('admin.user.permissions.update')
            ->middleware('check.permission:users,update');

        Route::post('/admin/users/search', [UserManagementController::class, 'search'])
            ->name('admin.users.search.post')
            ->middleware('check.permission:users,view');
    });

    // Moderator Routes
    Route::middleware(['role:2'])->group(function () {
        Route::get('content-moderation', [UserManagementController::class, 'contentModeration'])
            ->name('admin.content.moderation')
            ->middleware('check.permission:content,view');
    });
});
