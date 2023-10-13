<?php

namespace App\Http\Controllers;

use App\Http\Requests\payments\StorePaymentRequest;
use App\Http\Requests\payments\UpdatePaymentRequest;
use App\Models\Agreement;
use App\Models\Headquarter;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.payments.create', [
            'payment' => new Payment,
            'agreements' => Agreement::all(),
            'headquarters' => Headquarter::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\payments\StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = new Payment();
        $payment->agreement_id = $request->agreement_id;
        $payment->headquarter_id = $request->headquarter_id;
        $payment->user_id = $request->user()->id;
        $payment->credit_number = trim($request->input('credit_number'));
        $payment->credit_pos_number = trim($request->input('credit_pos_number'));
        $payment->receipt_number = trim($request->input('receipt_number'));
        $payment->value = $request->value;
        $payment->save();

        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('pages.payments.edit', [
            'payment' => $payment,
            'agreements' => Agreement::all(),
            'headquarters' => Headquarter::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\payments\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->agreement_id = $request->agreement_id;
        $payment->headquarter_id = $request->headquarter_id;
        $payment->user_id = $request->user()->id;
        $payment->credit_number = trim($request->input('credit_number'));
        $payment->credit_pos_number = trim($request->input('credit_pos_number'));
        $payment->receipt_number = trim($request->input('receipt_number'));
        $payment->update();

        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index');
    }

    public function report()
    {
        return view('pages.payments.report');
    }
}
