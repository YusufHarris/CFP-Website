<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling user information requests
    | This includes returning lists of users, updating user profile information
    |
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //
    public function index()
    {
        // Only show the home page if the user is logged in
        if ($this->checkUserStatus() == 0) {
            // Otherwise show the login page
            return view('auth.login');
        }

        // Otherwise redirect to the indicators mainboard page
        return redirect('indicators');
    }

    /**
     * Check user status
     *
     * @return int 0 - not logged in
     *             1 - logged in with enabled account
     *             2 - logged in with enabled account as Administrator
     */
    private function checkUserStatus()
    {
        // Ensure the user is logged in
        if (Auth::guard()->check()) {
            // And that the user is an administrator
            if (Auth::user()->enabled) {

                // Check if the user is an Administrator
                if (Auth::user()->admin) {
                    return 2;
                }
                return 1;
            }
            // Log the user out if the account is disabled
            else {
                Auth::logout();
            }
        }
        // Return false if the user is not logged in with an enabled account
        return 0;
    }
}
