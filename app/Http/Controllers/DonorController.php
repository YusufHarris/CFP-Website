<?php

namespace App\Http\Controllers;

use App\Models\Main\Donor;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DonorController extends Controller
{

    /**
     * Construct the controller with the privilages.
     *
     * @return Null
     */
    public function __construct()
    {
     $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $donors = Donor::all();

      return view('donors.index', compact('donors'));
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
      return view('donors.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //Validate donor entry
        $request->validate([
            'name' => 'required|max:191|string',
            'logo' => 'image|required',
        ]);

        // Set the current donor boolean value based on whether or not
        // it was ticked
        $current = $request->has('current') ? 1 : 0;

        // Save the logo
        $path = Storage::put('public/donors', $request->file('logo'));
        // Get the file extension of the logo
        $ext = $request->file('logo')->extension();

        // Create an original copy of the logo with '_orig' at the end of the
        // filename
        Storage::copy($path, str_replace('.'.$ext, '_orig.'.$ext, $path));

        // Update the logo path to use the public folder instead of the
        // storage folder for using Intervention Image
        $path = str_replace('public', '/storage', $path);

        // Resize the logo to 290px max size for display
        $img = Image::make('.'.$path);
        $max_size = 290;
        if ($img->width() > $img->height()) {
            $img->widen($max_size, function ($constraint) {
                $constraint->upsize();
            });
        } else {
            $img->heighten($max_size, function ($constraint) {
                $constraint->upsize();
            });
        }
        $img->save('.'.$path);

        // Create a 50px tall thumbnail of the photo
        $thm_path = str_replace('.'.$ext, '_thm.'.$ext, $path);
        $img->resize(null, 50, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save('.'.$thm_path);

        // Create donor
        Donor::create([
            'title' => $request->name,
            'logo' => $path,
            'current' => $current,
        ]);

        return redirect('donors')->with('success', $request->name . ' has been added to donors.');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\donor  donor
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $donor = Donor::FindOrFail($id);
        return view('donors.edit',compact('donor'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\donor  donor
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //Get the donor
        $donor = Donor::FindOrFail($id);

        // Validate donor entry
        $request->validate([
          'title' => 'required|max:191|string',
        ]);

        // Set the current donor boolean value based on whether or not
        // it was ticked
        $current = $request->has('current') ? 1 : 0;

        $logo = $donor->logo;

        if( $request->file('logo') ) {

            // Save the logo
            $path = Storage::put('public/donors', $request->file('logo'));
            // Get the file extension of the logo
            $ext = $request->file('logo')->extension();

            // Create an original copy of the logo with '_orig' at the end of the
            // filename
            Storage::copy($path, str_replace('.'.$ext, '_orig.'.$ext, $path));

            // Update the logo path to use the public folder instead of the
            // storage folder for using Intervention Image
            $path = str_replace('public', '/storage', $path);

            // Resize the logo to 290px max size for display
            $img = Image::make('.'.$path);
            $max_size = 290;
            if ($img->width() > $img->height()) {
                $img->widen($max_size, function ($constraint) {
                    $constraint->upsize();
                });
            } else {
                $img->heighten($max_size, function ($constraint) {
                    $constraint->upsize();
                });
            }

            $img->save('.'.$path);

            // Create a 50px tall thumbnail of the photo
            $thm_path = str_replace('.'.$ext, '_thm.'.$ext, $path);
            $img->resize(null, 50, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('.'.$thm_path);

            // Get the previous logo
            $prev_path = $donor->logo;

            // Update the logo
            $donor->logo = $path;

            // Update the logo path to use the storage folder instead of the
            // public folder for using the Storage facade
            $ext = pathinfo($prev_path, PATHINFO_EXTENSION);
            $path = str_replace('/storage', 'public', $prev_path);

            // Delete all copies of the previous logo
            Storage::delete([$path, str_replace('.'.$ext, '_orig.'.$ext, $path),
                             str_replace('.'.$ext, '_thm.'.$ext, $path)
                            ]);
        }

        // Update the title of the donor
        $donor->title = $request->title;
        // Update the status of the donor
        $donor->current = $current;

        // Save the donor
        $donor->save();

        return redirect('donors')->with('success', "Updated ".$donor->title."`s details.");
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Model\Main\donor  donor
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        // Get the donor
        $donor = Donor::FindOrFail($id);

        // Get the logo
        $path = $donor->logo;

        // Update the logo path to use the storage folder instead of the
        // public folder for using the Storage facade
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $path = str_replace('/storage', 'public', $path);

        // Delete the donor
        $donor->delete();

        // Delete all copies of the previous logo
        Storage::delete([$path, str_replace('.'.$ext, '_orig.'.$ext, $path),
                         str_replace('.'.$ext, '_thm.'.$ext, $path)
                        ]);

        return redirect('donors');
    }
}
