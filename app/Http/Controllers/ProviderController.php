<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.providers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.providers.forms.form-providers', [
            'provider' => new Provider(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'url_access' => 'nullable|url',
            'username' => 'nullable|alpha_num|max:50',
            'password' => 'nullable|string'
        ]);

        $provider = new Provider();
        $provider->user_id = $request->user()->id;
        $provider->name = $request->name;
        $provider->url_access = $request->url_access;
        $provider->username = $request->username;
        $provider->password = $request->password;
        $provider->annotations = $request->annotations;
        $provider->save();

        return redirect('/providers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        if($provider->user_id != Auth::user()->id && !Auth::user()->is_admin){
            return back()->with('message','Not authorized');
        }
        
        return view('', [
            'provider' => $provider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        if($provider->user_id != Auth::user()->id && !Auth::user()->is_admin){
            return back()->with('message','Not authorized');
        }

        return view('pages.providers.forms.form-providers', [
            'provider' => $provider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        if($provider->user_id != $request->user()->id && !$request->user()->is_admin){
            return back()->with('message','Not authorized');
        }

        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'url_access' => 'nullable|url',
            'username' => 'nullable|alpha_num|max:50',
            'password' => 'nullable|string'
        ]);

        $provider->url_access = $request->url_access;
        $provider->name = $request->name;
        $provider->username = $request->username;
        $provider->password = $request->password;
        $provider->annotations = $request->annotations;
        $provider->update();

        return redirect('/providers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        if($provider->user_id != Auth::user()->id && !Auth::user()->is_admin){
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $provider->delete();

        return response()->json([
            'code' => 200,
            'data' => $provider,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid(){
        if(!Auth::user()->is_admin){
            $providers = Provider::where('user_id', Auth::id())->get();
        }else{
            $providers = Provider::all();
        }

        return Datatables()->of($providers)->make();
    }
}