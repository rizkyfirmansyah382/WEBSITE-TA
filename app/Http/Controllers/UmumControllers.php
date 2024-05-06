<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UmumControllers extends Controller
{
    function beranda()
    {
        return view('umum.beranda');
    }
    function pemetaan()
    {
        return view('umum.pemetaan');
    }
}
