<?php

namespace App\Http\Controllers;

use App\Models\SocialMedium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialMediumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.social-media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.social-media.forms.form-social-media', [
            'socialMedium' => new SocialMedium(),
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
            'social_media' => 'required|string|min:3|max:100',
            'username' => 'required|alpha_num',
            'password' => 'required|string',
            'security_code' => 'string',
            'annotations' => 'nullable'
        ]);

        $social_media = new SocialMedium();
        $social_media->user_id = $request->user()->id;
        $social_media->social_media = $request->social_media;
        $social_media->username = $request->username;
        $social_media->password = $request->password;
        $social_media->security_code = $request->security_code;
        $social_media->annotations = $request->annotations;
        $social_media->save();

        return redirect('/social-media');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialMedium  $socialMedium
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMedium $socialMedium)
    {
        if ($socialMedium->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('', [
            'socialMedium' => $socialMedium
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialMedium  $socialMedium
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMedium $socialMedium)
    {
        if ($socialMedium->user_id != Auth::user()->id && !Auth::user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        return view('pages.social-media.forms.form-social-media', [
            'socialMedium' => $socialMedium,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialMedium  $socialMedium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialMedium $socialMedium)
    {
        if ($socialMedium->user_id != $request->user()->id && !$request->user()->is_admin) {
            return back()->with('message', 'Not authorized');
        }

        $request->validate([
            'social_media' => 'required|string|min:3|max:100',
            'username' => 'required|alpha_num',
            'password' => 'required|string',
            'security_code' => 'string',
            'annotations' => 'nullable'
        ]);

        $socialMedium->security_code = $request->security_code;
        $socialMedium->social_media = $request->social_media;
        $socialMedium->username = $request->username;
        $socialMedium->password = $request->password;
        $socialMedium->annotations = $request->annotations;
        $socialMedium->update();

        return redirect('/social-media');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialMedium  $socialMedium
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedium $socialMedium)
    {
        if($socialMedium->user_id != Auth::user()->id && !Auth::user()->is_admin){
            return response()->json([
                'code' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $socialMedium->delete();

        return response()->json([
            'code' => 200,
            'data' => $socialMedium,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        if (!Auth::user()->is_admin) {
            $socialMedium = SocialMedium::where('user_id', Auth::id())->get();
        } else {
            $socialMedium = SocialMedium::all();
        }

        return Datatables()->of($socialMedium)->make(true);
    }
}
