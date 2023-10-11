<?php

namespace App\Providers;

use App\View\Components\Invoices\Filter as InvoiceFilter;
use App\View\Components\Payments\Filter as PaymentFilter;
use Illuminate\Support\Facades\Blade;
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
    }
}
