<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clients.forms.form-clients', [
            'client' => new Client()
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
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|numeric|digits_between:6,15',
            'organization' => 'nullable|string|max:255',
            'iva' => 'nullable|numeric|min:0',
            'type_document' => 'required',
            'document' => 'required'
        ]);

        $client = new Client();
        $client->user_id = $request->user()->id;
        $client->name = $request->name;
        $client->type_document = $request->type_document;
        $client->document = $request->document;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->organization = $request->organization;
        $client->iva = $request->iva;
        $client->save();

        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        if ($client->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        if ($client->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('pages.clients.forms.form-clients', [
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if ($client->user_id != $request->user()->id && !$request->user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|numeric|digits_between:6,15',
            'organization' => 'nullable|string|max:255',
            'iva' => 'nullable|numeric|min:0',
            'type_document' => 'required',
            'document' => 'required'
        ]);

        $client->name = $request->name;
        $client->type_document = $request->type_document;
        $client->document = $request->document;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->organization = $request->organization;
        $client->iva = $request->iva;
        $client->update();

        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if ($client->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $client->delete();

        return response()->json([
            'code' => 200,
            'data' => $client,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        if (!Auth::user()->is_admin) {
            $clients = Client::where('user_id', Auth::id())->get();
        } else {
            $clients = Client::all();
        }

        return Datatables()->of($clients)->make(true);
    }
}
