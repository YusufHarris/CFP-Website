<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id', 'name', 'username', 'email', 'admin',
                              'enabled', 'created_at')
                    ->get();
        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the new user fields
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Set the admin boolean value based on whether or not
        // the Adminstrator Privilages was ticked
        $admin = $request->has('admin') ? 1 : 0;

        // Create the new user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'admin' => $admin,
            'password' => Hash::make($request->password),
        ]);

        return redirect('users')->with('success', $request->name . ' was created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->first();
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        // Retrieve the user
        $user = User::where('username', $username)->first();

        // Set the request checkbox values
        $admin = $request->admin == 1 ? 1 : 0;
        $enabled = $request->enabled == 1 ? 1 : 0;

        if( $user->email == $request->email && $user->name == $request->name &&
            $user->admin == $admin && $user->enabled == $enabled) {
                // Nothing was updated
                return redirect()->back()->with("error","No fields were updated.");
            }

        // Do not validate the email if it has not been updated
        if( $request->email == $user->email) {
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
        $user->admin = $admin;
        $user->enabled = $enabled;

        // Save the user
        $user->save();

        // Redirect to the user's edit page
        return redirect()->back()->with('success', "Updated the user details.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        // Retrieve the user
        $user = User::where('username', $username)->first();
        $user->delete();
        return redirect('users')->with('success', $user->name . ' was deleted.');
    }

}
