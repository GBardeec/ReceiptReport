<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Shop', 'prefix' => 'shop'], function () {
    Route::get('/', 'IndexController')->name('shop.index');
});

Route::group(['namespace' => 'App\Http\Controllers\MonthlyReport', 'prefix' => 'MonthlyReport'], function () {
    Route::get('/', 'IndexController')->name('MonthlyReport.index');
});

Route::group(['namespace' => 'App\Http\Controllers\ReportByDays', 'prefix' => 'ReportByDays'], function () {
    Route::get('/{month}', 'IndexController')->name('ReportByDays.index');
});

Route::group(['namespace' => 'App\Http\Controllers\ReportForTheDay', 'prefix' => 'ReportForTheDay'], function () {
    Route::get('/{date}', 'IndexController')->name('ReportForTheDay.index');
});

