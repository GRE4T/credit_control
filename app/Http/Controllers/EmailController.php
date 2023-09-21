<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.emails.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.emails.forms.form-emails', [
            'email' => new Email(),
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
            'type' => 'required|string',
            'email' => 'required|string',
            'username' => 'required|alpha_num|max:50',
            'password' => 'required|string',
            'url_access' => 'string',
            'expiration_from' => 'required',
            'expiration_to' => 'required',
            'security_question' => 'nullable|string',
            'annotations' => 'nullable'
        ]);

        $email = new Email();
        $email->user_id = $request->user()->id;
        $email->provider_id = $request->provider_id;
        $email->type = $request->type;
        $email->email = $request->email;
        $email->username = $request->username;
        $email->password = $request->password;
        $email->expiration_from = $request->expiration_from;
        $email->expiration_to = $request->expiration_to;
        $email->url_access = $request->url_access;
        $email->security_question = $request->security_question;
        $email->annotations = $request->annotations;
        $email->save();

        return redirect('/emails');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        if ($email->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('', [
            'email' => $email
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        if ($email->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('pages.emails.forms.form-emails', [
            'email' => $email,
            'providers' => Provider::where('user_id', Auth::id())->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $request->validate([
            'provider_id' => [
                'required', 'integer',
                Rule::exists('providers', 'id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                })
            ],
            'type' => 'required|string',
            'email' => 'required|string',
            'username' => 'required|alpha_num|max:50',
            'password' => 'required|string',
            'url_access' => 'string',
            'expiration_from' => 'required',
            'expiration_to' => 'required',
            'security_question' => 'nullable|string',
            'annotations' => 'nullable'
        ]);

        $email->provider_id = $request->provider_id;
        $email->email = $request->email;
        $email->username = $request->username;
        $email->password = $request->password;
        $email->expiration_from = $request->expiration_from;
        $email->expiration_to = $request->expiration_to;
        $email->url_access = $request->url_access;
        $email->security_question = $request->security_question;
        $email->annotations = $request->annotations;
        $email->save();

        return redirect('/emails');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        if ($email->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $email->delete();

        return response()->json([
            'code' => 200,
            'data' => $email,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        if (!Auth::user()->is_admin) {
            $emails = Email::where('user_id', Auth::id())->get()->load('provider', 'client', 'email');
        } else {
            $emails = Email::all()->load('provider');
        }

        return Datatables()->of($emails)->make(true);
    }


    public function emailsExpired()
    {
        $now = now();

        if (!Auth::user()->is_admin) {
            $certificatesExpired = Email::where('user_id', Auth::id())->where('expiration_to', '<', $now)->get()->load('provider');
        } else {
            $certificatesExpired = Email::all()->where('expiration_to', '<', $now)->load('provider');
        }

        return Datatables()->of($certificatesExpired)->make(true);
    }

    public function emailsExpiresSoon()
    {
        $now = now();
        $payment_date_add_days = date("Y-m-d", strtotime($now . "+ 1 months"));


        if (!Auth::user()->is_admin) {
            $emailsExpired = Email::where('user_id', Auth::id())
                ->where('expiration_to', '<', $payment_date_add_days)
                ->where('expiration_to', '>', $now)
                ->get()->load('provider');
        } else {
            $emailsExpired = Email::all()
                ->where('expiration_to', '<', $payment_date_add_days)
                ->where('expiration_to', '>', $now)
                ->load('provider');
        }

        return Datatables()->of($emailsExpired)->make(true);
    }
}
