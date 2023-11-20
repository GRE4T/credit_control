<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Invoices\ChangeStateRequest;
use App\Http\Requests\Api\Invoices\FilterInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceState;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    const PAYMENT_STATUS_CURRENT = 'current';
    public function index(FilterInvoiceRequest $request)
    {
        $query = Invoice::query();
        if (isset($request->filters)) {
            $filters = $request->filters;

            if (isset($filters['start_date'])) {
                $query->where('date', '>=', $filters['start_date']);
            }

            if (isset($filters['end_date'])) {
                $query->where('date', '<=', $filters['end_date']);
            }

            if (isset($filters['payment_status'])) {
                $date = date('Y-m-d');
                if ($filters['payment_status'] == self::PAYMENT_STATUS_CURRENT) {
                    $query->whereDate('expiration_date', '>=', $date);
                }else{
                    $query->whereDate('expiration_date', '<', $date);
                }
            }

            if (isset($filters['expiration_date_end'])) {
                $query->where('expiration_date', '<=', $filters['expiration_date_end']);
            }

            unset($filters['start_date']);
            unset($filters['end_date']);
            unset($filters['payment_status']);
            unset($filters['expiration_date_end']);

            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => [
                'grid' => DataTables::of($query->get()->load('agreement', 'headquarter', 'state', 'user'))->toJson(),
                'total' => $query->sum('value')
            ]
        ], 200);
    }

    public function changeStatus(ChangeStateRequest $request, Invoice $invoice){
        $state = InvoiceState::where('key', $request->invoice_state_key)->first();
        $invoice->invoice_state_id = $state->id;
        $invoice->save();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $invoice
        ], 200);
    }
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $invoice
        ], 200);
    }
}
