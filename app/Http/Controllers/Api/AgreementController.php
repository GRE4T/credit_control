<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Yajra\DataTables\DataTables;

class AgreementController extends Controller
{
    public function  index()
    {
        return Datatables::of(Agreement::query()->get()->load('user'))->make(true);
    }

    public function  destroy(Agreement $agreement)
    {
        $agreement->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $agreement
        ], 200);
    }
}
