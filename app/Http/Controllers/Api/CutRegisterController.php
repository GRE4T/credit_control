<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CutRegister;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CutRegisterController extends Controller
{
    public  function index()
    {
        return DataTables::of(CutRegister::query()->get()->load('user'))->make(true);
    }

    public function  destroy(CutRegister $cutRegister)
    {
        $cutRegister->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $cutRegister
        ], 200);
    }
}
