<?php

namespace App\Http\Controllers\Mandor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardMandorControllers extends Controller
{
    function index()
    {
        return view('mandor.dashboard.index');
    }
}
