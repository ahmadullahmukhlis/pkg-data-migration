<?php

use App\Http\Controllers\exportController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [exportController::class, 'insertContact']);
