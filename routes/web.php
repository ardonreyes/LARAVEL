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
Route::get('/customers', [Customer::class, 'read']);
Route::get('/users', [User::class, 'read']);

Route::get('/users/create', [User::class, 'read']);
Route::get('/users/edit/{num}', [User::class, 'read'])->whereNumber('num');
Route::get('/users/delete/{num}', [User::class, 'read'])->whereNumber('num');
Route::get('/customers/create', [Customer::class, 'read']);
Route::get('/customers/edit/{num}', [Customer::class, 'read'])->whereNumber('num');
Route::get('/customers/delete/{num}', [Customer::class, 'read'])->whereNumber('num');

Route::post('/customers/create', [Customer::class, 'create']);
Route::post('/customers/edit/{num}', [Customer::class, 'update'])->whereNumber('num');
Route::delete('/customers/delete/{num}', [Customer::class, 'delete'])->whereNumber('num');
Route::post('/users/create', [User::class, 'create']);
Route::post('/users/edit/{num}', [User::class, 'update'])->whereNumber('num');
Route::delete('/users/delete/{num}', [User::class, 'delete'])->whereNumber('num');
