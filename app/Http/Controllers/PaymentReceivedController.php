<?php

namespace App\Http\Controllers;

use App\Http\Requests\paymentsreceived\StorePaymentReceivedRequest;
use App\Http\Requests\paymentsreceived\UpdatePaymentReceivedRequest;
use App\Models\Agreement;
use App\Models\Headquarter;
use App\Models\PaymentReceived;

class PaymentReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.paymentsreceived.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.paymentsreceived.create', [
            'paymentreceived' => new PaymentReceived,
            'agreements' => Agreement::all(),
            'headquarters' => Headquarter::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\paymentsreceived\StorePaymentReceivedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentReceivedRequest $request)
    {
        $paymentreceived = new PaymentReceived();
        $paymentreceived->agreement_id = $request->agreement_id;
        $paymentreceived->headquarter_id = $request->headquarter_id;
        $paymentreceived->value = $request->value;
        $paymentreceived->type_payment = trim($request->input('type_payment'));
        $paymentreceived->receipt_number = trim($request->input('receipt_number'));
        $paymentreceived->save();

        return redirect()->route('paymentsreceived.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentReceived  $paymentreceived
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentReceived $paymentreceived)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentReceived  $paymentreceived
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentReceived $paymentreceived)
    {
        return view('pages.paymentsreceived.edit', [
            'paymentreceived' => $paymentreceived,
            'agreements' => Agreement::all(),
            'headquarters' => Headquarter::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\paymentsreceived\UpdatePaymentReceivedRequest  $request
     * @param  \App\Models\PaymentReceived  $paymentreceived
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentReceivedRequest $request, PaymentReceived $paymentreceived)
    {

        $paymentreceived->agreement_id = $request->agreement_id;
        $paymentreceived->headquarter_id = $request->headquarter_id;
        $paymentreceived->type_payment = trim($request->input('type_payment'));
        $paymentreceived->receipt_number = trim($request->input('receipt_number'));
        $paymentreceived->update();

        return redirect()->route('paymentsreceived.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentReceived  $paymentreceived
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentReceived $paymentreceived)
    {
        $paymentreceived->delete();
        return redirect()->route('paymentsreceived.index');
    }
}
