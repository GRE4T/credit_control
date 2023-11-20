<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PeriodCut\FilterCutRequest;
use App\Models\Agreement;
use App\Models\Headquarter;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMade;
use App\Models\PaymentReceived;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeriodCutController extends Controller
{
    public function index(FilterCutRequest $request)
    {

        $filters = $request->filled('filters') ? $request->filters : [];

        $data = Agreement::withSum([
            'payments' => function ($query) use ($filters) {
                $this->applyFilters($query, $filters, 'date');
            },
            'invoices' => function ($query) use ($filters) {
                $query->whereHas('state', fn($subQuery) => $subQuery->where('key', '!=', config('agreements.state_3')));
                $this->applyFilters($query, $filters, 'date');
            },
            'paymentsMade' => function ($query) use ($filters) {
                $this->applyFilters($query, $filters);
            },
            'paymentsReceived' => function ($query) use ($filters) {
                $this->applyFilters($query, $filters);
            }
        ], 'value')
            ->where(function ($query) use ($filters) {
                if (isset($filters['agreement_id'])) {
                    $query->where('id', $filters['agreement_id']);
                }
            })
            ->get();


        return DataTables::of($data)->make(true);
    }

    private function  applyFilters($query, $filters, $dateField = 'created_at'){
        if (isset($filters['start_date'])) {
            $query->where($dateField, '>=', $filters['start_date']);
        }

        if (isset($filters['end_date'])) {
            $query->where($dateField, '<=', $filters['end_date']);
        }
    }

}
