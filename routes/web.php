<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\HeadquarterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentMadeController;
use App\Http\Controllers\PaymentReceivedController;
use App\Http\Controllers\PeriodCutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfigurationController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {

        //Navigation base
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/home', function (){
            return redirect('/');
        })->name('home');

        //Agreements
        Route::resource('/agreements', AgreementController::class)->except('show');

        //Payments
        Route::get('/payments/report', [PaymentController::class, 'report'])->name('payments.report');
        Route::resource('/payments', PaymentController::class)->except('show');

        //Headquarters
        Route::resource('/headquarters', HeadquarterController::class)->except('show');

        //Invoices
        Route::get('/invoices/report', [InvoiceController::class, 'report'])->name('invoices.report');
        Route::resource('/invoices', InvoiceController::class)->except('show');

        //Payments Made
        Route::resource('/paymentsmade', PaymentMadeController::class)->except('show');

        //Payments Received
        Route::resource('/paymentsreceived', PaymentReceivedController::class)->except('show');

        //Period Cut
        Route::get('/period-cut', [PeriodCutController::class, 'index'])->name('periodCut');

        //Users
        Route::resource('/users', UserController::class)->except('show')->middleware('admin');

        //Route profile
        Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::put('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
        Route::post('/user/updatePassword', [UserController::class, 'updatePassword'])->name('user.password');

        //Configuration
        Route::post('/configurations', [ConfigurationController::class, 'store'])->name('configurations.store');

        //Code Status
        Route::view('notAuthorized', 'others.notAuthorized')->name('notAuthorized');

});

// Auth::routes();
Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login',  [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');


//Forgot Password
Route::get('/forgot-password', [PasswordController::class, 'index'])->name('password.forgot');
Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'passwordUpdate'])->name('password.update');

