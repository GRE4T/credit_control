<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\invoices\ChangeStateRequest;
use App\Http\Requests\Api\invoices\FilterInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceState;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index(FilterInvoiceRequest $request)
    {
        $query = Invoice::query();
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
                'grid' => DataTables::of($query->get()->load('agreement', 'headquarter', 'state'))->toJson(),
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
