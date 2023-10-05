<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgreementController;
use App\Http\Controllers\Api\HeadquarterController;


/*
|--------------------------------------------------------------------------
| API Routes AJAX
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api local ajax" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth')->group(function (){
    Route::get('/agreements', [AgreementController::class, 'index']);
    Route::delete('/agreements/{agreement}', [AgreementController::class, 'destroy']);
});

Route::middleware('auth')->group(function (){
    Route::get('/headquarters', [HeadquarterController::class, 'index']);
    Route::delete('/headquarters/{headquarter}', [HeadquarterController::class, 'destroy']);
});
