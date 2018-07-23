<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ensure the user is an administrator
        if ($this->checkUserStatus() < 2) {
            return redirect('/');
        }

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
        // Ensure the user is an administrator
        if ($this->checkUserStatus() < 2) {
            return redirect('/');
        }

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
        // Ensure the user creating the new user account is an administrator
        if ($this->checkUserStatus() < 2) {
            return redirect('/');
        }

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Ensure the user is logged in
        if ($this->checkUserStatus() < 2) {
            return redirect('/');
        }

        return redirect('users/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Retrieve the user
        $user = User::find($id);

        // Rules for Administrator updating an account
        if ($this->checkUserStatus() == 2)
        {
            // Validate the data
            // Check if the email has been updated and validate accordingly
            if($request->email == $user->email) {
                // Validate the user fields
                $request->validate([
                    'name' => 'required|string|max:255'
                ]);
            }
            else {
                // Validate the user fields
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users'
                ]);

            }

            // Update the user
            $user->email = $request->email;
            $user->name = $request->name;
            $user->admin = $request->admin == 1 ? 1 : 0;
            $user->enabled = $request->enabled == 1 ? 1 : 0;

            // Save the user
            $user->save();

            return redirect('users/'.$id.'/edit')->with('success', "Updated the account details.");
        }


        // Rules for user updating their own account
        elseif (Auth::id() == $id) {
            // Validate the data
            // Check if the email has been updated and validate accordingly
            if($request->email == $user->email) {
                // Validate the user fields
                $request->validate([
                    'name' => 'required|string|max:255'
                ]);
            }
            else {
                // Validate the user fields
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users'
                ]);

            }

            // Update the user
            $user->email = $request->email;
            $user->name = $request->name;

            // Save the user
            $user->save();

            return redirect('users/'.$id.'/edit')->with('success', "Updated the account details.");

        }
        // Otherwise, return the login home page
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('users')->with('success', $user->name . ' has been deleted');
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
