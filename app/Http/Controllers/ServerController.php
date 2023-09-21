<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Provider;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.servers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.servers.forms.form-servers', [
            'server' => new Server(),
            'providers' => Provider::where('user_id', Auth::id())->get(),
            'clients' => Client::where('user_id', Auth::id())->get(),
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
            'path_server' => 'required|string|max:250',
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
            'operating_system' => 'required|in:LINUX,WINDOWS',
            'username' => 'required|alpha_num|max:50',
            'password' => 'required|string',
            'url' => 'nullable|url',
            'annual_cost' => 'nullable|numeric|min:0',
            'annotations' => 'nullable|string',
            'nameserver1' => 'nullable',
            'nameserver2' => 'nullable',
            'nameserver3' => 'nullable',
            'nameserver4' => 'nullable'
        ]);

        $server = new Server();
        $server->user_id = $request->user()->id;
        $server->server = $request->path_server;
        $server->provider_id = $request->provider_id;
        $server->client_id = $request->client_id;
        $server->operating_system = $request->operating_system;
        $server->username = $request->username;
        $server->password = $request->password;
        $server->url = $request->url;
        $server->annual_cost = $request->annual_cost;
        $server->annotations = $request->annotations;
        $server->nameserver1 = $request->nameserver1;
        $server->nameserver2 = $request->nameserver2;
        $server->nameserver3 = $request->nameserver3;
        $server->nameserver4 = $request->nameserver4;
        $server->register_date = $request->register_date;
        $server->expiration_date = $request->expiration_date;
        $server->save();

        return redirect('/servers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
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
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        if ($server->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('pages.servers.forms.form-servers', [
            'server' => $server,
            'providers' => Provider::where('user_id', Auth::id())->get(),
            'clients' => Client::where('user_id', Auth::id())->get(),
            'sos' => ['LINUX', 'WINDOWS']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        if ($server->user_id != $request->user()->id && !$request->user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }
        $request->validate([
            'path_server' => 'required|string|max:250',
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
            'operating_system' => 'required|in:LINUX,WINDOWS',
            'username' => 'required|alpha_num|max:50',
            'password' => 'required|string',
            'url' => 'nullable|url',
            'annual_cost' => 'nullable|numeric|min:0',
            'annotations' => 'nullable|string',
            'nameserver1' => 'nullable',
            'nameserver2' => 'nullable',
            'nameserver3' => 'nullable',
            'nameserver4' => 'nullable'
        ]);

        $server->server = $request->path_server;
        $server->provider_id = $request->provider_id;
        $server->client_id = $request->client_id;
        $server->operating_system = $request->operating_system;
        $server->username = $request->username;
        $server->password = $request->password;
        $server->url = $request->url;
        $server->annual_cost = $request->annual_cost;
        $server->annotations = $request->annotations;
        $server->nameserver1 = $request->nameserver1;
        $server->nameserver2 = $request->nameserver2;
        $server->nameserver3 = $request->nameserver3;
        $server->nameserver4 = $request->nameserver4;
        $server->register_date = $request->register_date;
        $server->expiration_date = $request->expiration_date;
        $server->update();

        return redirect('/servers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        if ($server->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $server->delete();

        return response()->json([
            'code' => 200,
            'data' => $server,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        if (!Auth::user()->is_admin) {
            $servers = Server::where('user_id', Auth::id())->get()->load('provider', 'client');
        } else {
            $servers = Server::all()->load('provider', 'client');
        }

        return response()->json([
            'code' => 200,
            'data' => $servers,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function getServerBySO($so)
    {
        if (!Auth::user()->is_admin) {
            $servers = Server::where('user_id', Auth::id())
                ->where('operating_system', $so)->get();
        } else {
            $servers = Server::where('operating_system', $so)->get();
        }

        return response()->json([
            'code' => 200,
            'data' => $servers,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function serversExpired()
    {
        $now = now();

        if (!Auth::user()->is_admin) {
            $serversExpired = Server::where('user_id', Auth::id())->where('expiration_date', '<', $now)->get()->load('provider', 'client');
        } else {
            $serversExpired = Server::all()->where('expiration_date', '<', $now)->load('provider', 'client');
        }

        return response()->json([
            'code' => 200,
            'data' => $serversExpired,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function serversExpiresSoon()
    {
        $now = now();
        $payment_date_add_days = date("Y-m-d", strtotime($now . "+ 1 months"));

        if (!Auth::user()->is_admin) {
            $serversExpired = Server::where('user_id', Auth::id())
            ->where('expiration_date', '<', $payment_date_add_days)
            ->where('expiration_date', '>', $now)
            ->get()->load('provider', 'client');
        } else {
            $serversExpired = Server::all()
            ->where('expiration_date', '<', $payment_date_add_days)
            ->where('expiration_date', '>', $now)
            ->load('provider', 'client');
        }

        return Datatables()->of($serversExpired)->make(true);
    }
}
