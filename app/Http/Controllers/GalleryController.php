<?php

namespace App\Http\Controllers;

use App\r;
use App\Models\Main\Gallery;
use App\Models\Main\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('galleries.index',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery = Gallery::create([
          'title' => $request->title,
          'sector' => $request->sector
        ]);

        $gallery_id = $gallery->id;

        $photos = Photo::select()->where('gallery_id', $gallery_id)->get();
        return view('galleries.show', compact('gallery_id','gallery', 'photos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos = Photo::select()->where('gallery_id', $id)->get();
        $gallery = Gallery::select()->find($id);
        return view('galleries.show', compact('photos'), compact('gallery'));
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
      //Get the Beneficiary
      $gallery = Gallery::where('id', $id)->first();
      $gallery->delete();

      return redirect('galleries');
    }
}
