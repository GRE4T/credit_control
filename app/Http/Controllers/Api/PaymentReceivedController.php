<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentReceived;
use App\Http\Requests\Api\PaymentsReceived\FilterPaymentReceivedRequest;
use Yajra\DataTables\DataTables;

class PaymentReceivedController extends Controller
{
    public function  index(FilterPaymentReceivedRequest $request)
    {
        $query = PaymentReceived::query();
        if (isset($request->filters)) {
            $filters = $request->filters;

            if (isset($filters['start_date'])) {
                $query->where('created_at', '>=', $filters['start_date']);
            }

            if (isset($filters['end_date'])) {
                $query->where('created_at', '<=', $filters['end_date']);
            }

            unset($filters['start_date']);
            unset($filters['end_date']);
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => [
                'grid' => DataTables::of($query->get()->load('agreement', 'headquarter', 'user'))->toJson(),
                'total' => $query->sum('value')
            ]
        ], 200);
    }

    public function destroy(PaymentReceived $paymentreceived)
    {
        $paymentmade->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $paymentreceived
        ], 200);
    }
}
