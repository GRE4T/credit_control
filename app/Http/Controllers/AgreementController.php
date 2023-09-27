<?php

namespace App\Http\Controllers;

use App\Http\Requests\agreements\StoreAgreementRequest;
use App\Http\Requests\agreements\UpdateAgreementRequest;
use App\Models\Agreement;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.agreements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.agreements.create', [
            'agreement' => new Agreement
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\agreements\StoreAgreementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgreementRequest $request)
    {
        $agreement = new Agreement();
        $agreement->name = $request->name;
        $agreement->save();

        return redirect()->route('agreements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function show(Agreement $agreement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function edit(Agreement $agreement)
    {
        return view('pages.agreements.edit', [
            'agreement' => $agreement
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\agreements\UpdateAgreementRequest  $request
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgreementRequest $request, Agreement $agreement)
    {
        $agreement->name = $request->name;
        $agreement->update();

        return redirect()->route('agreements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agreement $agreement)
    {
        $agreement->delete();
        return redirect()->route('agreements.index');
    }
}
