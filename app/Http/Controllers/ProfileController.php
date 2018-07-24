<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('enabled');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('auth.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Retrieve the user
        $user = Auth::user();

        // Do not validate the email if it has not been updated
        if( $request->email == $user->email) {
            if( $request->name == $user->name) {
                // Nothing was updated
                return redirect()->back()->with("error","No fields were updated.");
            }
            // Validate the user fields
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
        } else {
            // Validate the user fields
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);
        }

        // Update the user
        $user->email = $request->email;
        $user->name = $request->name;

        // Save the user
        $user->save();

        // Redirect to the user's edit page
        return redirect()->back()->with('success', "Your account profile was updated.");
    }

    /**
     * Disable the current user's account
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable()
    {
        // Retrieve the user
        $user = Auth::user();
        // Disable the user account
        $user->enabled = 0;
        $user->save();
        // Logout the user
        Auth::logout();

        return redirect('/')->with('success', 'Your account was disabled.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('auth.passwords.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords match
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password are the same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        // Update the password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect('profile')->with("success","Your account password was updated.");
    }

}
