<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Headquarter;
use Illuminate\Http\Request;

class PeriodCutController extends Controller
{
    public function index()
    {
        return view('pages.periodCut.index',[
            'agreements' => Agreement::all()
        ]);
    }
}
