<?php

use App\Http\Controllers\exportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [exportController::class, 'insertCustomer']);
