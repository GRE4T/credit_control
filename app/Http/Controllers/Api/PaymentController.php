<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function  index()
    {
        return DataTables::of(Payment::query()->get()->load('agreement', 'headquarter'))->make(true);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $payment
        ], 200);
    }
}
