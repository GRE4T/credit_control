<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\invoices\ChangeStateRequest;
use App\Models\Invoice;
use App\Models\InvoiceState;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index()
    {
        return DataTables::of(Invoice::query()->get()->load('agreement', 'headquarter', 'state'))->make(true);
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
