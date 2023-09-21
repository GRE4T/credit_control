<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class SubscriptionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.subscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.subscriptions.forms.form-subscriptions', [
            'subscription' => new Subscription(),
            'providers' => Provider::where('user_id', Auth::id())->get()
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
            'url' => 'string',
            'username' => 'required|max:50',
            'password' => 'required|string',
            'expiration_from' => 'required',
            'expiration_to' => 'required',
            'cost' => 'nullable|numeric|min:0',
            'days' => 'nullable',
            'annotations' => 'nullable'
        ]);

        $subscription = new Subscription();
        $subscription->user_id = $request->user()->id;
        $subscription->provider_id = $request->provider_id;
        $subscription->url = $request->url;
        $subscription->username = $request->username;
        $subscription->password = $request->password;
        $subscription->expiration_from = $request->expiration_from;
        $subscription->expiration_to = $request->expiration_to;
        $subscription->cost = $request->cost;
        $subscription->days = $request->days;
        $subscription->annotations = $request->annotations;
        $subscription->save();

        return redirect('/subscriptions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        if ($subscription->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('', [
            'subscription' => $subscription
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        if ($subscription->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('pages.subscriptions.forms.form-subscriptions', [
            'subscription' => $subscription,
            'providers' => Provider::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'provider_id' => [
                'required', 'integer',
                Rule::exists('providers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'url' => 'required|string',
            'username' => 'required|alpha_num|max:50',
            'password' => 'required|string',
            'cost' => 'string',
            'expiration_from' => 'required',
            'expiration_to' => 'required',
            'days' => 'nullable|string',
            'annotations' => 'nullable'
        ]);

        $subscription->provider_id = $request->provider_id;
        $subscription->username = $request->username;
        $subscription->password = $request->password;
        $subscription->expiration_from = $request->expiration_from;
        $subscription->expiration_to = $request->expiration_to;
        $subscription->url = $request->url;
        $subscription->cost = $request->cost;
        $subscription->days = $request->days;
        $subscription->annotations = $request->annotations;
        $subscription->save();

        return redirect('/subscriptions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        if ($subscription->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $subscription->delete();

        return response()->json([
            'code' => 200,
            'data' => $subscription,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        if (!Auth::user()->is_admin) {
            $subscriptions = Subscription::where('user_id', Auth::id())->get()->load('provider', 'client', 'email');
        } else {
            $subscriptions = Subscription::all()->load('provider');
        }

        return response()->json([
            'code' => 200,
            'data' => Datatables()->of($subscriptions)->make(true),
            'message' => 'Request executed successfully'
        ], 200);
    }


    public function subscriptionsExpired()
    {
        $now = now();

        if (!Auth::user()->is_admin) {
            $subscriptionsExpired = Subscription::where('user_id', Auth::id())->where('expiration_to', '<', $now)->get()->load('provider');
        } else {
            $subscriptionsExpired = Subscription::all()->where('expiration_to', '<', $now)->load('provider');
        }

        return response()->json([
            'code' => 200,
            'data' => Datatables()->of($subscriptionsExpired)->make(true),
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function subscriptionsExpiresSoon()
    {
        $now = now();
        $payment_date_add_days = date("Y-m-d", strtotime($now . "+ 1 months"));


        if (!Auth::user()->is_admin) {
            $subscriptionsExpired = Subscription::where('user_id', Auth::id())
                ->where('expiration_to', '<', $payment_date_add_days)
                ->where('expiration_to', '>', $now)
                ->get()->load('provider');
        } else {
            $subscriptionsExpired = Subscription::all()
                ->where('expiration_to', '<', $payment_date_add_days)
                ->where('expiration_to', '>', $now)
                ->load('provider');
        }

        return response()->json([
            'code' => 200,
            'data' => Datatables()->of($subscriptionsExpired)->make(true),
            'message' => 'Request executed successfully'
        ], 200);
    }
}
