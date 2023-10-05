<?php

namespace App\Http\Controllers;

use App\Http\Requests\payments\StorePaymentRequest;
use App\Http\Requests\payments\UpdatePaymentRequest;
use App\Models\Agreement;
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
            'headquarters' => Agreement::all()
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
        $payment->credit_number = trim($request->input('credit_number'));
        $payment->credit_pos_number = trim($request->input('credit_pos_number'));
        $payment->number_received = trim($request->input('number_received'));
        $payment->value = $request->value;
        $payment->save();

        return view('pages.payments.index');
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
            'headquarters' => Agreement::all()
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
        $payment->credit_number = trim($request->input('credit_number'));
        $payment->credit_pos_number = trim($request->input('credit_pos_number'));
        $payment->number_received = trim($request->input('number_received'));
        $payment->update();


        return view('pages.payments.index');
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
        return view('pages.payments.index');
    }
}
