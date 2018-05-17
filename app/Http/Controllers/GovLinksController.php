<?php

namespace App\Http\Controllers;


// use Illuminate\Http\Request;
use App\Models\GovLinks;

class GovLinksController extends Controller
{
    public function index()
    {
        $agencies = GovLinks::getGovAgencies();
        $workshops = GovLinks::getGovWorkshops();

        return view('gov-links', compact('agencies', 'workshops'));
    }
}
