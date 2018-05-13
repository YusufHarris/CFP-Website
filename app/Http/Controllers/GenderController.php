<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\Gender;

class GenderController extends Controller
{
    public function index()
    {
        $communities = Gender::getSROIACommunities();

        return view('gender', compact('communities'));
    }
}
