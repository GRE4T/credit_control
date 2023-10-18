<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdatePasswordUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create', [
            'user' => new User
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = Carbon::now();

        if($request->filled('is_admin'))
            $user->is_admin = $request->is_admin;

        $user->save();

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        if($request->filled('is_admin'))
            $user->is_admin = $request->is_admin;
        else
            $user->is_admin = false;

        if (isset($request->password))
            $user->password = Hash::make($request->password);

        $user->update();

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = User::find($request->user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->update();

        return redirect('/user/profile');
    }

    public function updatePassword(UpdatePasswordUserRequest $request)
    {
        $user = User::find($request->user()->id);

        $user->password = Hash::make($request->password);
        $user->update();

        return redirect('/user/profile');
    }

    public function profile()
    {
        return view('others.user-profile', [
            'user' => auth()->user()
        ]);
    }
}
