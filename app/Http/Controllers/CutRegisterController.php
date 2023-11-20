<?php

namespace App\Http\Controllers;

use App\Http\Requests\CutRegisters\StoreCutRegisterRequest;
use App\Http\Requests\CutRegisters\UpdateCutRegisterRequest;
use App\Models\CutRegister;

class CutRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cutRegisters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.cutRegisters.create', [
            'cutRegister' => new CutRegister
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CutRegisters\StoreCutRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCutRegisterRequest $request)
    {
        $cutRegister = new CutRegister();
        $cutRegister->user_id = $request->user()->id;
        $cutRegister->value = $request->value;
        $cutRegister->date = $request->date;
        $cutRegister->save();

        return  redirect()->route('cut-registers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CutRegister  $cutRegister
     * @return \Illuminate\Http\Response
     */
    public function show(CutRegister $cutRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CutRegister  $cutRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(CutRegister $cutRegister)
    {
        return view('pages.cutRegisters.edit', [
            'cutRegister' => $cutRegister
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CutRegisters\UpdateCutRegisterRequest  $request
     * @param  \App\Models\CutRegister  $cutRegister
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCutRegisterRequest $request, CutRegister $cutRegister)
    {
        $cutRegister->user_id = $request->user()->id;
        $cutRegister->value = $request->value;
        $cutRegister->date = $request->date;
        $cutRegister->update();

        return  redirect()->route('cut-registers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CutRegister  $cutRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(CutRegister $cutRegister)
    {
        $cutRegister->delete();
        return  redirect()->route('cut-registers.index');
    }
}
