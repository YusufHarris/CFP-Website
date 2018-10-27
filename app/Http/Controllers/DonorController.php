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

/*  public function update_logo(Request $request){
    if($request->hasFile('logo')){
      $logo = $request->file('logo');
      $filetitle = time() . '.' . $logo->getClientOriginalExtension();
      Image::make($logo)->resize(150,150)->save(public_path($directory));


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
      //Validate donor entry
      $request->validate([
        'name' => 'required|max:191|string',
        'logo' => 'image|required',
      ]);

      // Save the image
      $path = Storage::put('public/donorLogos/' . $request->id, $request->file('logo'));
      // Update the photo path to use the public folder instead of the
      // storage folder
      $path = str_replace('public', '/storage', $path);

      // Create the thumbnail of the photo
      $thm_path = str_replace('.jpeg', '-thm.jpeg', $path);
      $img = Image::make('.'.$path);
      $img->resize(null, 100, function ($constraint) {
          $constraint->aspectRatio();
      });
      $img->save('.'.$thm_path);

      //Create donor
      Donor::create([
        'title' => $request->name,
        'logo' => $thm_path,
      ]);

      return redirect('donors')->with('success', $request->name . ' has been added to donors.');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\donor  donor
   * @return \Illuminate\Http\Response
   */

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\donor  donor
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $donor = Donor::FIndOrFail($id);
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

    //Validate donor entry
    $request->validate([
      'name' => 'required|max:191|string',
      'logo' => 'image',
    ]);

    if( $request->file('avatar') ) {

        // Save the image
        $path = Storage::put('public/donorLogos/' . $request->id, $request->file('avatar'));
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

        $donor->logo = $thm_path;
    }

    //Designate which data goes where
    $donor->title = $request->title;

    // Save the donor
    $donor->save();
    return redirect()->back()->with('success', "Updated ".$donor->title."`s details.");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Model\Main\donor  donor
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //Get the donor
    $donor = Donor::FindOrFail($id);
    //Delete the donor
    $donor->delete();

    return redirect('donors');
  }
}
