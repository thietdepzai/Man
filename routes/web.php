<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/danh-muc', function () {
    return view('danh-muc');
})->name('danh-muc');

Route::get('/san-pham', function () {
    return view('san-pham');
})->name('san-pham');

Route::get('/gio-hang', function () {
    return view('gio-hang');
})->name('gio-hang');

Route::get('/thanh-toan', function () {
    return view('thanh-toan');
})->name('thanh-toan');

Route::get('/tim-kiem', function () {
    return view('tim-kiem');
})->name('tim-kiem');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/don-hang', function () {
    return view('don-hang');
})->name('don-hang');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

use App\Http\Controllers\ProductController;
Route::post('/admin/upload', [ProductController::class, 'uploadImage'])->name('admin.upload');


