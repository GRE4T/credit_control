<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMade;
use App\Models\PaymentReceived;

class HomeController extends Controller
{
    public function  index()
    {
        $date = date('Y-m-d');

        $dayPayments = Payment::whereDate('created_at', $date)->sum('value');
        $dayInvoices = Invoice::whereDate('created_at', $date)->sum('value');
        $dayPaymentsMade = PaymentMade::whereDate('created_at', $date)->sum('value');
        $dayPaymentsReceived = PaymentReceived::whereDate('created_at', $date)->sum('value');

        return view('pages.home.index', [
            'payments' => number_format($dayPayments, 2, '.', ','),
            'invoices' => number_format($dayInvoices, 2, '.', ','),
            'paymentsMade' => number_format($dayPaymentsMade, 2, '.', ','),
            'paymentsReceived' => number_format($dayPaymentsReceived, 2, '.', ',')
        ]);
    }
}
