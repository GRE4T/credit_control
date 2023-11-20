<?php

namespace App\Providers;

use App\Models\Configuration;
use App\Models\CutRegister;
use App\View\Components\Invoices\Filter as InvoiceFilter;
use App\View\Components\Payments\Filter as PaymentFilter;
use App\View\Components\PaymentsMade\Filter as PaymentMadeFilter;
use App\View\Components\PaymentsReceived\Filter as PaymentReceivedFilter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('payments-filter', PaymentFilter::class);
        Blade::component('invoices-filter', InvoiceFilter::class);
        Blade::component('paymentsmade-filter', PaymentMadeFilter::class);
        Blade::component('paymentsreceived-filter', PaymentReceivedFilter::class);



        if(Schema::hasTable('configurations')){
            $configuration = Configuration::first();
            if(is_null($configuration)){
                $configuration = (object) [
                    'logo' =>  asset('assets/images/icons/logo.png')
                ];
            }
        }else{
            $configuration = (object) [
                'logo' =>  asset('assets/images/icons/logo.png')
            ];
        }



        view()->share('configuration', $configuration);
        view()->share('sum_cut_register', Schema::hasTable('cut_registers') ? CutRegister::sum('value') : 0);
    }
}
