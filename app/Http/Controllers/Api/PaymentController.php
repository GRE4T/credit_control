<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payments\FilterPaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(FilterPaymentRequest $request)
    {
        $query = Payment::query();
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
