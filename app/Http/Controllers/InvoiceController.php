<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoices\StoreInvoiceRequest;
use App\Http\Requests\Invoices\UpdateInvoiceRequest;
use App\Models\Agreement;
use App\Models\Headquarter;
use App\Models\Invoice;
use App\Models\InvoiceState;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.invoices.create', [
            'invoice' => new Invoice,
            'agreements'=> Agreement::all(),
            'headquarters'=> Headquarter::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Invoices\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $state = InvoiceState::where('key', config('agreements.state_1'))->firstOrFail();

        $invoice = new Invoice();
        $invoice->agreement_id = $request->agreement_id;
        $invoice->headquarter_id = $request->headquarter_id;
        $invoice->user_id = $request->user()->id;
        $invoice->invoice_pos_number = trim($request->input('invoice_pos_number'));
        $invoice->invoice_agreement = trim($request->input('invoice_agreement'));
        $invoice->value = $request->value;
        $invoice->detail = trim($request->detail);
        $invoice->invoice_state_id = $state->id;
        $invoice->save();

        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return view('pages.invoices.edit', [
            'invoice' => $invoice,
            'agreements'=> Agreement::all(),
            'headquarters'=> Headquarter::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Invoices\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->agreement_id = $request->agreement_id;
        $invoice->headquarter_id = $request->headquarter_id;
        $invoice->user_id = $request->user()->id;
        $invoice->invoice_pos_number = trim($request->input('invoice_pos_number'));
        $invoice->invoice_agreement = trim($request->input('invoice_agreement'));
        $invoice->detail = trim($request->detail);

        if($request->filled('value')) {
            $invoice->value = $request->value;
        }

        $invoice->save();

        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index');
    }

    public function report()
    {
        return view('pages.invoices.report');
    }
}
