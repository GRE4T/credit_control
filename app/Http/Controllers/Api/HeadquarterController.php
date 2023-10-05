<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Headquarter;
use DataTables;

class HeadquarterController extends Controller
{
    public function  index()
    {
        return Datatables::of(Headquarter::query())->make(true);
    }

    public function  destroy(Headquarter $headquarter)
    {
        $headquarter->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Successfully executed',
            'data' => $headquarter
        ], 200);
    }
}
