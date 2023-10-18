<?php

namespace App\Http\Controllers;

use App\Http\Requests\headquarters\StoreHeadquarterRequest;
use App\Http\Requests\headquarters\UpdateHeadquarterRequest;
use App\Models\Headquarter;

class HeadquarterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.headquarters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.headquarters.create', [
            'headquarter' => new headquarter
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\headquarters\StoreHeadquarterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHeadquarterRequest $request)
    {
        $headquarter = new Headquarter();
        $headquarter->name = $request->name;
        $headquarter->user_id = $request->user()->id;
        $headquarter->save();

        return redirect()->route('headquarters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Headquarter $headquarter
     * @return \Illuminate\Http\Response
     */
    public function show(Headquarter $headquarter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Headquarter $headquarter
     * @return \Illuminate\Http\Response
     */
    public function edit(Headquarter $headquarter)
    {
        return view('pages.headquarters.edit', [
            'headquarter' => $headquarter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\headquarters\UpdateHeadquarterRequest  $request
     * @param  \App\Models\Headquarter  $headquarter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHeadquarterRequest $request, Headquarter $headquarter)
    {
        $headquarter->name = $request->name;
        $headquarter->user_id = $request->user()->id;
        $headquarter->update();

        return redirect()->route('headquarters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Headquarter $headquarter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Headquarter $headquarter)
    {
        $headquarter->delete();
        return redirect()->route('headquarters.index');
    }
}
