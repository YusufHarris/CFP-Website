<?php

namespace App\Http\Controllers;


use App\Models\Main\Photo;
use App\Models\Main\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();


        return view('photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gallery_id)
    {
        return view('photo.create', compact('gallery_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $gallery_id)
    {
        // Validate the request
        $request->validate([
          'filename' => 'image',
          'description' => 'string|max:255|required'
        ]);

        // Save the image
        $path = Storage::put('public/galleries/' . $gallery_id, $request->file('filename'));
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

        // Create the photo record in the database
        Photo::create([
          'filename' => $thm_path,
          'description' => $request->description,
          'gallery_id' => $gallery_id
        ]);

        return redirect('/galleries/'.$gallery_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(r $r)
    {
        $photos = Photo::all();
        return view('photo.index', compact('photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(r $r)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, r $r)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::where('id',$id)->first();
        $photo->delete();
        return redirect()->back();
    }
}
