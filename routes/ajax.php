<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgreementController;
use App\Http\Controllers\Api\HeadquarterController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentMadeController;
use App\Http\Controllers\Api\PaymentReceivedController;
use App\Http\Controllers\Api\PeriodCutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CutRegisterController;

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

    Route::get('/paymentsreceived', [PaymentReceivedController::class, 'index']);
    Route::delete('/paymentsreceived/{paymentreceived}', [PaymentReceivedController::class, 'destroy']);

    Route::get('/period-cut', [PeriodCutController::class, 'index']);
    Route::get('/cut-registers', [CutRegisterController::class, 'index']);
    Route::delete('/cut-registers/{cutRegister}', [CutRegisterController::class, 'destroy']);


    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    Route::put('/users/{user}/change-state', [UserController::class, 'changeStatus']);

    Route::get('/home/graph-payments', [HomeController::class, 'getGraphPayments']);
    Route::get('/home/graph-payments-by-agreement', [HomeController::class, 'getGraphPaymentsByAgreement']);
});
