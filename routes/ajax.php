<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgreementController;
use App\Http\Controllers\Api\HeadquarterController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentMadeController;


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

    Route::get('/payments', [PaymentController::class, 'index']);
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy']);

    Route::get('/headquarters', [HeadquarterController::class, 'index']);
    Route::delete('/headquarters/{headquarter}', [HeadquarterController::class, 'destroy']);

    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::put('/invoices/{invoice}/change-state', [InvoiceController::class, 'changeStatus']);
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy']);

    Route::get('/paymentsmade', [PaymentMadeController::class, 'index']);
    Route::delete('/paymentsmade/{paymentmade}', [PaymentMadeController::class, 'destroy']);
});
