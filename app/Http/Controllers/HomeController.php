<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Main\Beneficiary;
use App\Models\Main\Employee;
use App\Models\Main\Gallery;

class HomeController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        $beneficiaries = Beneficiary::take(4)->get();
        $galleries = Gallery::take(4)->with('images')->take(1)->get();
        return view('welcome', compact('employees','beneficiaries','galleries'));
    }
}
