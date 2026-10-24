<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    Home,
    About,
    Customer,
    User,
};

// Page routes
Route::get('/', [Home::class, 'page']);
Route::get('/about', [About::class, 'page']);
Route::get('/customers', [Customer::class, 'page']);
Route::get('/users', [User::class, 'page']);
