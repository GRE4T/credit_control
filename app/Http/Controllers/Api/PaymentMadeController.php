<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMade;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentMadeController extends Controller
{
    public function  index()
    {
        return DataTables::of(PaymentMade::query()->get()->load('agreement', 'headquarter'))->make(true);
    }

    public function destroy(PaymentMade $paymentmade)
    {
        $paymentmade->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $paymentmade
        ], 200);
    }
}
