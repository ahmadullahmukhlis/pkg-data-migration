<?php

use App\Http\Controllers\exportController;
use App\Http\Controllers\testcontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', [exportController::class, 'jpb']);
// Route::get('/home', [testcontroller::class, 'index']);
//SELECT * FROM `contacts` WHERE contactable_type = 'App\\Models\\Bgpkg\\BgpkgCustomer';
