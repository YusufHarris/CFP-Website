<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\GovLinks;

class GovLinksController extends Controller
{
    public function index()
    {
        $communities = GovLinks::getSROIACommunities();

        return view('gov-links', compact('communities'));
    }
}
