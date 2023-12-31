<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentsMade\StorePaymentMadeRequest;
use App\Http\Requests\PaymentsMade\UpdatePaymentMadeRequest;
use App\Models\Agreement;
use App\Models\Headquarter;
use App\Models\PaymentMade;

class PaymentMadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.paymentsmade.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.paymentsmade.create', [
            'paymentmade' => new PaymentMade,
            'agreements' => Agreement::all(),
            'headquarters' => Headquarter::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PaymentsMade\StorePaymentMadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentMadeRequest $request)
    {
        $paymentmade = new PaymentMade();
        $paymentmade->agreement_id = $request->agreement_id;
        $paymentmade->headquarter_id = $request->headquarter_id;
        $paymentmade->user_id = $request->user()->id;
        $paymentmade->value = $request->value;
        $paymentmade->type_payment = trim($request->input('type_payment'));
        $paymentmade->receipt_number = trim($request->input('receipt_number'));
        $paymentmade->detail = trim($request->detail);
        $paymentmade->save();

        return redirect()->route('paymentsmade.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMade  $paymentmade
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMade $paymentmade)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMade  $paymentmade
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMade $paymentmade)
    {
        return view('pages.paymentsmade.edit', [
            'paymentmade' => $paymentmade,
            'agreements' => Agreement::all(),
            'headquarters' => Headquarter::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PaymentsMade\UpdatePaymentMadeRequest  $request
     * @param  \App\Models\PaymentMade  $paymentmade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentMadeRequest $request, PaymentMade $paymentmade)
    {

        $paymentmade->agreement_id = $request->agreement_id;
        $paymentmade->headquarter_id = $request->headquarter_id;
        $paymentmade->user_id = $request->user()->id;
        $paymentmade->type_payment = trim($request->input('type_payment'));
        $paymentmade->receipt_number = trim($request->input('receipt_number'));
        $paymentmade->detail = trim($request->detail);

        if($request->filled('value')) {
            $paymentmade->value = $request->value;
        }

        $paymentmade->update();

        return redirect()->route('paymentsmade.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMade  $paymentmade
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMade $paymentmade)
    {
        $paymentmade->delete();
        return redirect()->route('paymentsmade.index');
    }
}
