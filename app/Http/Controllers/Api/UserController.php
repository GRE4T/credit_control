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

    public function changeStatus(User $user)
    {
        $user->active = !$user->active;
        $user->update();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $user
        ], 200);
    }

    public function destroy(User $user)
    {
        if(!$user->has('payments')){
            $user->delete();
        } else {
            $user->active = false;
            $user->update();
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $user
        ], 200);
    }
}
