<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/csrf-token', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});


Route::get('/', function () {
    return ['LottoPlay Api laravel: ' => app()->version()];
});
