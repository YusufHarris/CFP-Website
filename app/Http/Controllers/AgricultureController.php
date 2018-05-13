<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Agriculture;

class AgricultureController extends Controller
{
    public function index()
    {
        $communities = Agriculture::getSROIACommunities();

        return view('agriculture', compact('communities'));
    }
}
