<?php

use App\Http\Controllers\GoodController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    return Redirect::to('/shop/goods');
});
Route::get('/home', function () {
    return Redirect::to('/shop/goods');
});

Route::resource('/shop/goods', GoodController::class)->middleware('auth');
Route::get('/shop/goods/{id}/review', [GoodController::class, 'reviewGood'])->middleware('auth');
Auth::routes();

