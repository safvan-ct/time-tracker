<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/profile', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile.update');

Route::group(['middleware' => ['auth', 'user']], function(){
    Route::get('/dashboard/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user.home');
});

Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/dashboard/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home');
    Route::resource('task', App\Http\Controllers\TaskController::class, ['names' => 'task']);
    Route::post('/task-assign/{id}', [App\Http\Controllers\TaskController::class, 'assign'])->name('task.assign');
    Route::get('/user-list', [App\Http\Controllers\UserTaskController::class, 'index'])->name('user.list');
});
