<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeriodCutController extends Controller
{
    public function index()
    {
        return view('periodCut.index');
    }
}
