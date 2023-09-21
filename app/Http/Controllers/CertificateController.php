<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.certificates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.certificates.forms.form-certificates', [
            'certificate' => new Certificate(),
            'domains' => Domain::where('user_id', Auth::id())->get(),
            'providers' => Provider::where('user_id', Auth::id())->get(),
            'clients' => Client::where('user_id', Auth::id())->get(),
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
            'domain_id' => [
                'required', 'integer',
                Rule::exists('domains', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'client_id' => [
                'required', 'integer',
                Rule::exists('clients', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'provider_id' => [
                'required', 'integer',
                Rule::exists('providers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'type' => 'required|string',
            'certificate' => 'required|string',
            'expiration_from' => 'required',
            'expiration_to' => 'required',
            'annotations' => 'nullable|string',
            'IP_address' => 'nullable'
        ]);

        $certificate = new Certificate();
        $certificate->user_id = $request->user()->id;
        $certificate->domain_id = $request->domain_id;
        $certificate->client_id = $request->client_id;
        $certificate->provider_id = $request->provider_id;
        $certificate->type = $request->type;
        $certificate->certificate = $request->certificate;
        $certificate->expiration_from = $request->expiration_from;
        $certificate->expiration_to = $request->expiration_to;
        $certificate->IP_address = $request->IP_address;
        $certificate->private_key = $request->private_key;
        $certificate->CA_bundle = $request->CA_bundle;
        $certificate->annotations = $request->annotations;
        $certificate->save();

        return redirect('/certificates');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        if ($certificate->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('', [
            'certificate' => $certificate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        if ($certificate->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('pages.certificates.forms.form-certificates', [
            'certificate' => $certificate,
            'providers' => Provider::where('user_id', Auth::id())->get(),
            'domains' => Domain::where('user_id', Auth::id())->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        if ($certificate->user_id != $request->user()->id && !$request->user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        $request->validate([
            'domain_id' => [
                'required', 'integer',
                Rule::exists('domains', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'client_id' => [
                'required', 'integer',
                Rule::exists('clients', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'provider_id' => [
                'required', 'integer',
                Rule::exists('providers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'type' => 'required|string',
            'certificate' => 'required|string',
            'expiration_from' => 'required',
            'expiration_to' => 'required',
            'annotations' => 'nullable|string',
            'IP_address' => 'nullable'
        ]);

        $certificate->type = $request->type;
        $certificate->domain_id = $request->domain_id;
        $certificate->client_id = $request->client_id;
        $certificate->provider_id = $request->provider_id;
        $certificate->certificate = $request->certificate;
        $certificate->expiration_from = $request->expiration_from;
        $certificate->expiration_to = $request->expiration_to;
        $certificate->IP_address = $request->IP_address;
        $certificate->private_key = $request->private_key;
        $certificate->CA_bundle = $request->CA_bundle;
        $certificate->annotations = $request->annotations;
        $certificate->update();

        return redirect('/certificates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        if ($certificate->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $certificate->delete();

        return response()->json([
            'code' => 200,
            'data' => $certificate,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        if (!Auth::user()->is_admin) {
            $certificates = Certificate::where('user_id', Auth::id())->get()->load('provider', 'domain', 'client');
        } else {
            $certificates = Certificate::all()->load('provider', 'domain');
        }

        return Datatables()->of($certificates)->make(true);
    }


    public function certificatesExpired()
    {
        $now = now();

        if (!Auth::user()->is_admin) {
            $certificatesExpired = Certificate::where('user_id', Auth::id())->where('expiration_to', '<', $now)->get()->load('provider', 'client', 'domain');
        } else {
            $certificatesExpired = Certificate::all()->where('expiration_to', '<', $now)->load('provider', 'client', 'domain');
        }

        return Datatables()->of($certificatesExpired)->make(true);
    }

    public function certificatesExpiresSoon()
    {
        $now = now();
        $payment_date_add_days = date("Y-m-d", strtotime($now . "+ 1 months"));


        if (!Auth::user()->is_admin) {
            $certificatesExpired = Certificate::where('user_id', Auth::id())
                ->where('expiration_to', '<', $payment_date_add_days)
                ->where('expiration_to', '>', $now)
                ->get()->load('provider', 'client', 'domain');
        } else {
            $certificatesExpired = Certificate::all()
                ->where('expiration_to', '<', $payment_date_add_days)
                ->where('expiration_to', '>', $now)
                ->load('provider', 'client', 'domain');
        }

        return Datatables()->of($certificatesExpired)->make(true);
    }
}
