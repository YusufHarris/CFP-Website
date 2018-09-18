<?php

namespace App\Http\Controllers;


use App\Models\Main\Image;
use App\Models\Main\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();


        return view('image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gallery_id)
    {
        return view('image.create', compact('gallery_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $gallery_id)
    {
        $request->validate([
          'imageName' => 'image',
          'description' => 'string|max:255|required'
        ]);
        $path = Storage::put('public/galleries/' . $gallery_id, $request->file('imageName'), 'public');
        $path = str_replace('public', '/storage', $path);
        Image::create([
          'imageName' => $path,
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
        $images = Image::all();
        return view('image.index', compact('images'));
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
        $image = Image::where('id',$id)->first();
        $image->delete();
        return redirect()->back();
    }
}
