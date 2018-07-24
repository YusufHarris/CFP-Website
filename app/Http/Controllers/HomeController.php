<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        // Check if the user is logged in
        if (Auth::guard()->check()) {
            // Redirect to the indicators page if the user is enabled
            if (Auth::user()->enabled) {
                return redirect('indicators');
            // Otherwise log out the user
            } else {
                Auth::logout();
            }
        }

        // Show the login page if the user is not logged in
        return view('welcome');
    }
}
