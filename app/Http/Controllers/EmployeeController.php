<?php

namespace App\Http\Controllers;

use App\Models\Main\Employee;
use Illuminate\Http\Request;
use App\Models\Main\Photo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


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
          'avatar' => 'image|required',
        ]);

        // Save the image
        $path = Storage::put('public/empavatars/' . $request->id, $request->file('avatar'));
        // Update the photo path to use the public folder instead of the
        // storage folder
        $path = str_replace('public', '/storage', $path);

        // Create the thumbnail of the photo
        $thm_path = str_replace('.jpeg', '-thm.jpeg', $path);
        $img = Image::make('.'.$path);
        $img->resize(255, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save('.'.$thm_path);

        //Create Employee
        Employee::create([
          'name' => $request->name,
          'title'=> $request->title,
          'description' => $request->description,
          'avatar' => $thm_path,
        ]);

        return redirect('employees')->with('success', $request->name . ' has been added to employees.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $employee = Employee::FindOrFail($id);
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
      $employee = Employee::FindOrFail($id);

      //Validate Employee entry
      $request->validate([
        'name' => 'required|max:191|string',
        'title' => 'required|max:191|string',
        'description' => 'required|max:191|string',
        'avatar' => 'image',
      ]);

      if( $request->file('avatar') ) {

          // Save the image
          $path = Storage::put('public/empavatars/' . $request->id, $request->file('avatar'));
          // Update the photo path to use the public folder instead of the
          // storage folder
          $path = str_replace('public', '/storage', $path);

          // Create the thumbnail of the photo and save it
          $thm_path = str_replace('.jpeg', '-thm.jpeg', $path);
          $img = Image::make('.'.$path);
          $img->resize(255, null, function ($constraint) {
              $constraint->aspectRatio();
          });
          $img->save('.'.$thm_path);

          $employee->avatar = $thm_path;
      }

            //Designate which data goes where
      $employee->name = $request->name;
      $employee->title = $request->title;
      $employee->description = $request->description;

      // Save the Employee
      $employee->save();
      return redirect()->back()->with('success', "Updated ".$employee->name."`s details.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //Get the Employee
      $employee = Employee::where('id', $id)->first();
      //Delete the Employee
      $employee->delete();

      return redirect('employees');
    }
}
