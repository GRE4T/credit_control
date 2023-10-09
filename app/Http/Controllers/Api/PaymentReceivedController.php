<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentReceived;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentReceivedController extends Controller
{
    public function  index()
    {
        return DataTables::of(PaymentReceived::query()->get()->load('agreement', 'headquarter'))->make(true);
    }

    public function destroy(paymentreceived $paymentreceived)
    {
        $paymentreceived->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $paymentreceived
        ], 200);
    }
}
