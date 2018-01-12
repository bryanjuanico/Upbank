<?php

namespace MHBank\BBMS\Http\Controllers;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    
    public function viewHospitals(){
    	$hospitals = Hospital::orderBy('hospital_id')->get();
    	return view ('hospitals', ['hospitals' => $hospitals]);
    }

    public function createHospital(){
    	return view ('hospital_add');
    }

    public function getInput(Request $request){
    	$name = $request->input('hName');
    	$location = $request->input('location');

    	$hospital = new Hospital;
    	$hospital->hospital_name = $name;
    	$hospital->location = $location;
    	$hospital->save();

    	return redirect()->route('hospitals')->with('alert-success', 'Hospital successfully added!');
    }
}
