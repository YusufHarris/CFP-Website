<?php

namespace App\Http\Controllers;


use App\Models\Main\Beneficiary;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BeneficiaryController extends Controller
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
        $beneficiaries = Beneficiary::all();
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beneficiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate Beneficiary entry
        $request->validate([
            'name' => 'required|max:191|string',
            'introduction' => 'required|max:191|string',
            'avatar' => 'required|image',
        ]);

        // Save the image
        $path = Storage::put('public/benavatars/' . $request->id, $request->file('avatar'));
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

        //Create Beneficiary
        Beneficiary::create([
            'name' => $request->name,
            'introduction' => $request->introduction,
            'avatar' => $thm_path,
        ]);

        return redirect('beneficiaries')->with('success', $request->name . ' has been added to beneficiaries.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiary = Beneficiary::where('id', $id)->first();
        return view('beneficiaries.edit',compact('beneficiary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Get the Beneficiary
        $beneficiary = Beneficiary::where('id', $id)->first();

        //Validate Beneficiary entry
        $request->validate([
            'name' => 'required|max:191|string',
            'introduction' => 'required|max:191|string',
            'avatar' => 'image',
        ]);

        // Update the image only if an image was selected
        if( $request->file('avatar') ) {

            // Save the image
            $path = Storage::put('public/benavatars/' . $request->id, $request->file('avatar'));
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

            $beneficiary->avatar = $thm_path;
        }


        $beneficiary->name = $request->name;
        $beneficiary->introduction = $request->introduction;


        // Save the Beneficiary with confirmation
        $beneficiary->save();
        return redirect()->back()->with('success', "Updated ".$beneficiary->name."`s details.");
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         //Get the Beneficiary
         $beneficiary = Beneficiary::where('id', $id)->first();
         $beneficiary->delete();

         return redirect('beneficiaries')->with('success', "Deleted ".$beneficiary->name."`s details.");
     }
}
