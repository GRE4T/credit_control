<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Domain;
use App\Models\Provider;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.domains.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.domains.forms.form-domains', [
            'domain' => new Domain(),
            'providers' => Provider::where('user_id', Auth::id())->get(),
            'clients' => Client::where('user_id', Auth::id())->get(),
            'servers' => Server::where('user_id', Auth::id())->get(),
            'sos' => ['LINUX', 'WINDOWS']
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

            'provider_id' => [
                'required', 'integer',
                Rule::exists('providers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'client_id' => [
                'required', 'integer',
                Rule::exists('clients', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'server_id' => [
                'required', 'integer',
                Rule::exists('servers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'operating_system' => 'required|in:LINUX,WINDOWS',
            'domain' => 'required|string',
            'website' => 'nullable|string',
            'annual_price' => 'nullable|numeric|min:0',
            'observations' => 'nullable|string'
        ]);

        $domain = new Domain();
        $request['user_id'] = $request->user()->id;
        $domain->create($request->all());

        return redirect('/domains');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domain  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $server)
    {
        if ($server->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('', [
            'server' => $server
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        if ($domain->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('pages.domains.forms.form-domains', [
            'domain' => $domain,
            'providers' => Provider::where('user_id', Auth::id())->get(),
            'clients' => Client::where('user_id', Auth::id())->get(),
            'servers' => Server::where('user_id', Auth::id())->get(),
            'sos' => ['LINUX', 'WINDOWS']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        $request->validate([

            'provider_id' => [
                'required', 'integer',
                Rule::exists('providers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'client_id' => [
                'required', 'integer',
                Rule::exists('clients', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'server_id' => [
                'required', 'integer',
                Rule::exists('servers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'operating_system' => 'required|in:LINUX,WINDOWS',
            'domain' => 'required|string',
            'website' => 'required|string',
            'annual_price' => 'nullable|numeric|min:0',
            'observations' => 'nullable|string'
        ]);

        $domain->client_id = $request->client_id;
        $domain->domain = $request->domain;
        $domain->website = $request->website;
        $domain->nameserver1 = $request->nameserver1;
        $domain->nameserver2 = $request->nameserver2;
        $domain->nameserver3 = $request->nameserver3;
        $domain->nameserver4 = $request->nameserver4;
        $domain->provider_id = $request->provider_id;
        $domain->operating_system = $request->operating_system;
        $domain->server_id = $request->server_id;
        $domain->authorization_code = $request->authorization_code;
        $domain->annual_price = $request->annual_price;
        $domain->register_date = $request->register_date;
        $domain->expiration_date = $request->expiration_date;
        $domain->host_FTP = $request->host_FTP;
        $domain->user_FTP = $request->user_FTP;
        $domain->password_FTP = $request->password_FTP;
        $domain->port_FTP = $request->port_FTP;
        $domain->client_FTP = $request->client_FTP;
        $domain->observations = $request->observations;
        $domain->update();

        return redirect('/domains');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        if ($domain->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $domain->delete();

        return response()->json([
            'code' => 200,
            'data' => $domain,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        if (!Auth::user()->is_admin) {
            $domains = Domain::where('user_id', Auth::id())->get()->load('provider', 'client', 'server');
        } else {
            $domains = Domain::all()->load('provider', 'client', 'server');
        }

        return  Datatables()->of($domains)->make(true);
    }

    public function domainsExpired()
    {
        $now = now();

        if (!Auth::user()->is_admin) {
            $domainsExpired = Domain::where('user_id', Auth::id())->where('expiration_date', '<', $now)->get()->load('provider', 'client', 'server');
        } else {
            $domainsExpired = Domain::all()->where('expiration_date', '<', $now)->load('provider', 'client', 'server');
        }

        return Datatables()->of($domainsExpired)->make(true);
    }

    public function domainsExpiresSoon()
    {
        $now = now();
        $payment_date_add_days = date("Y-m-d", strtotime($now . "+ 1 months"));


        if (!Auth::user()->is_admin) {
            $domainsExpired = Domain::where('user_id', Auth::id())
                ->where('expiration_date', '<', $payment_date_add_days)
                ->where('expiration_date', '>', $now)
                ->get()->load('provider', 'client', 'server');
        } else {
            $domainsExpired = Domain::all()
                ->where('expiration_date', '<', $payment_date_add_days)
                ->where('expiration_date', '>', $now)
                ->load('provider', 'client', 'server');
        }

        return Datatables()->of($domainsExpired)->make(true);
    }
}
