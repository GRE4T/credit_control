<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function  index()
    {
        return DataTables::of(User::query())->make(true);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $user
        ], 200);
    }
}
