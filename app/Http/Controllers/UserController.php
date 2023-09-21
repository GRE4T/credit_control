<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('pages.users.forms.form-users', [
            'user' => new User(),
            'roles' => Role::all()
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email:rfc,dns|unique:users',
            'username' => 'required|alpha_num|unique:users|min:6|max:35',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:App\Models\Role,id',
            'verified' => 'nullable|boolean',
            'active' => 'nullable|boolean'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->email_verified_at = $request->verified ? Carbon::now() : null;
        $user->active = $request->active ?? 0;
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
        return view('', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.users.forms.form-users', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email:rfc,dns|unique:users,email,'.$user->id.',id',
            'username' => 'required|alpha_num|min:6|max:35|unique:users,username,'.$user->id.',id',
            'password' => 'nullable|string|min:8',
            'role' => 'required|exists:App\Models\Role,id',
            'active' => 'nullable|boolean'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->role_id = $request->role;
        $user->active = $request->active ?? 0;

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
        $user->active = !$user->active;
        $user->update();

        return response()->json([
            'code' => 200,
            'data' => $user,
            'message' => 'Request executed successfully'
        ], 200);
    }

    public function grid()
    {
        return Datatables()->of(User::orderBy('id','desc')->get()->load('role'))->make(true);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->user()->id);
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email:rfc,dns|unique:users,email,'.$user->id.',id',
            'username' => 'required|alpha_num|min:6|max:35|unique:users,username,'.$user->id.',id',

        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->update();

        return redirect('/user/profile');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find($request->user()->id);
        $request->validate([
            'password_current' => 'required|password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->update();

        return redirect('/user/profile');
    }
}
