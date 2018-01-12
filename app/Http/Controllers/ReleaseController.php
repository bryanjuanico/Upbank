<?php

namespace App\Http\Controllers;
use App\Models\Release;
use App\Models\Client;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReleaseController extends Controller
{	

	public function viewReleases() {
    	$releases = Release::select( DB::raw('DISTINCT(release.release_id), release.datereleased, client.*, hospital.*') )
                    ->join('bloodstorage', 'bloodstorage.release_id', '=', 'release.release_id')
    				->join('hospital', 'hospital.hospital_id', '=', 'release.hospital_id')
    				->join('client', 'release.client_id', '=', 'client.client_id')
    				->where('client.client_type', 'RECIPIENT')
    				->orderBy('release.datereleased', 'desc')
                    ->get();
    	return view ('releases', ['releases' => $releases]);
    }

	public function chooseRecipient() {
    	$clients = Client::select('client_id', 'client_name', 'client_bloodtype', 'client_gender')->orderBy('client_id')->where('client_type', 'RECIPIENT')->paginate(10);
    	return view ('choose_recipient', ['clients' => $clients]);
    }

    public function apply(Request $request){
        $clients = (new Client)->newQuery();

         if ($request->has('namesearch')) {
            $clients->where('client_name','ilike', '%'.$request->input('namesearch').'%');
         }


         if ($request->has('groupsearch')) {
            
            if ($request->has('rhsearch')){
                $clients->where('client_bloodtype', 'like', $request->input('groupsearch').$request->input('rhsearch'));
            } else {
                $clients->where('client_bloodtype', 'like', $request->input('groupsearch').'_');
            }
         }

        return $clients->where('client_type', 'RECIPIENT')->orderBy('client_name')->paginate(10);
    }

    public function filter(Request $request){
        $clients = ReleaseController::apply($request);
        return view('choose_recipient', ['clients'=>$clients]);
    }

    public function createRelease($clientID){
    	$hospitals = Hospital::all();
    	return view ('release_blood', ['hospitals' => $hospitals, 'clientID' => $clientID]);
    }

    public function getInput(Request $request, $clientID){
    	$release = new Release;
    	$hospitalname = $request->input('hospitalname');
    	$diag = $request->input('diagnosis');
    	$hospitals = Hospital::where('hospital_name', $hospitalname)->select('hospital_id')->get();

    	foreach ($hospitals as $hospital) {
    		$hospitalid = $hospital->hospital_id;
    	}


    	$release->client_id = $clientID;
    	$release->hospital_id = $hospitalid;
    	$release->diagnosis = $diag;

        // Gets the user ID of the current user
        $userid = Auth::user()->id;

        $release->id = $userid;
    	$release->save();

    	$relID = $release->max('release_id');

    	$rel = new BloodstorageController;
    	return $rel->showQuantityInput($relID);
    }

    public function showRelease($releaseid){
        $released = Release::join('bloodstorage', 'bloodstorage.release_id', '=', 'release.release_id')
                           ->join('client as rc', 'release.client_id','=','rc.client_id')
                           ->join('donation', 'donation.donation_id','=','bloodstorage.donation_id')
                           ->join('client as dc', 'donation.client_id','=','dc.client_id')
                           ->join('hospital','hospital.hospital_id','=','release.hospital_id')
                           ->join('users', 'users.id', '=', 'release.id')
                           ->where('release.release_id', $releaseid)
                           ->select('rc.client_name as r', 'dc.client_name as d', 'bloodstorage.*', 'release.*', 'donation.*', 'hospital.*', 'users.*')
                           ->get();
        return view('release_about', ['released'=>$released]);
    }
}
