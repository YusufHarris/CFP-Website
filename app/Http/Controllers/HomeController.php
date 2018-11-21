<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Main\Beneficiary;
use App\Models\Main\Employee;
use App\Models\Main\Gallery;
use App\Models\Main\Donor;

class HomeController extends Controller
{

    public function index()
    {
        $donors = Donor::select()->orderBy('current', 'desc')->get();
        $employees = Employee::all();
        $beneficiaries = Beneficiary::all();
        $galleries = Gallery::take(4)->with('photos')->get();
        return view('welcome', compact('employees','beneficiaries','galleries','donors'));
    }
}
