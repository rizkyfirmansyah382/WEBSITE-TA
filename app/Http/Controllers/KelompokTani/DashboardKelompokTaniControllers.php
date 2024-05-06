<?php

namespace App\Http\Controllers\KelompokTani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardKelompokTaniControllers extends Controller
{
    function index()
    {
        return view("kelompoktani.dashboard.index");
    }
}
