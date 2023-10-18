<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getGraphPayments()
    {
        $date = Carbon::now();

        $data = Payment::select(DB::raw('DAY(created_at) as day'), DB::raw('SUM(value) as value'))
            ->whereMonth('created_at', $date->month)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get()->pluck('value', 'day')->toArray();

        $labels = range(1, $date->daysInMonth);
        $values = array_map(fn($item) => $data[$item] ?? 0, $labels);


        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => [
                'labels' => $labels,
                'values' => $values
            ]
        ], 200);
    }

    public function getGraphPaymentsByAgreement()
    {
        $data = Agreement::withSum('payments', 'value')->get()->pluck('payments_sum_value', 'name')->toArray();
        $labels = array_keys($data);
        $values = array_values($data);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => [
                'labels' => $labels,
                'values' => $values
            ]
        ], 200);
    }

}
