<?php

namespace App\Http\Controllers;

use App\Models\Main\Employee;
use Illuminate\Http\Request;
use App\Models\Main\Image;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware('auth');
     }
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

  /*  public function update_avatar(Request $request){
      if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(150,150)->save(public_path($directory));


        }
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validate Employee entry
        $request->validate([
          'name' => 'required|max:191|string',
          'title' => 'required|max:191|string',
          'description' => 'required|max:191|string',
          'avatar' => 'image',
        ]);

        //Save picture file
        $path = $request->file('avatar')->store('public/empavatars');

        //Create Employee
        Employee::create([
          'name' => $request->name,
          'title'=> $request->title,
          'description' => $request->description,
          'avatar' => $request->file('avatar')->store('storage/empavatars'),
        ]);

        return redirect('employees')->with('success', $request->name . ' has been added to employees.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $employee = Employee::where('id', $id)->first();
      return view('employees.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //Get the Employee
      $employee = Employee::where('id', $id)->first();

      //Validate Employee entry
      $request->validate([
        'name' => 'required|max:191|string',
        'title' => 'required|max:191|string',
        'description' => 'required|max:191|string',
        'avatar' => 'image',
      ]);

      //Designate which data goes where
      $path = $request->file('avatar')->store('public/empavatars');
      $employee->name = $request->name;
      $employee->title = $request->title;
      $employee->description = $request->description;
      $employee->avatar = $request->file('avatar')->store('storage/empavatars');


      // Save the Employee
      $employee->save();
      $employees = Employee::all();
      return redirect('employees')->with('success', "Updated ".$employee->name."`s details.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //Get the Beneficiary
      $employee = Employee::where('id', $id)->first();
      $employee->delete();

      return redirect('employees');
    }
}
