<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function block()
    {
        return view('home.tracking.block');
    }
}
