<?php

namespace App\Http\Controllers;


use App\Models\Main\Beneficiary;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

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
        'occupation' => 'required|max:191|string',
        'introduction' => 'required|max:191|string',
        'avatar' => 'image',
      ]);

      //Save Picture file
      $path = $request->file('avatar')->store('public/benavatars');

      //Create Beneficiary
      Beneficiary::create([
        'name' => $request->name,
        'occupation'=> $request->occupation,
        'introduction' => $request->introduction,
        'avatar' => $request->file('avatar')->store('storage\benavatars'),
      ]);
      return redirect('beneficiaries')->with('success', $request->name . ' has been added to beneficiaries.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(r $r)
    {
        //
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
         'occupation' => 'required|max:191|string',
         'introduction' => 'required|max:191|string',
         'avatar' => 'image',
       ]);

       $path = $request->file('avatar')->store('public/benavatars');
       $beneficiary->name = $request->name;
       $beneficiary->occupation = $request->occupation;
       $beneficiary->introduction = $request->introduction;
       $beneficiary->avatar = $request->file('avatar')->store('storage/benavatars');


       // Save the Beneficiary with confirmation
       $beneficiary->save();
       $beneficiaries = Beneficiary::all();
       return redirect('employees')->with('success', "Updated ".$beneficiary->name."`s details.");
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

         return redirect('beneficiaries');
     }
}
