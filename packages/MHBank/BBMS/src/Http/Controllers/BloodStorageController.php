<?php

namespace MHBank\BBMS\Http\Controllers;
use App\Models\Bloodstorage;
use App\Models\Release;
use App\Models\Donation;
use App\Models\Client;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BloodstorageController extends Controller
{   

  public function showBloodbag($bloodstorageid){
    $infos = DB::table('bloodstorage as b')
                ->join('donation as d', 'd.donation_id', '=', 'b.donation_id')
                ->join('client as dc', 'dc.client_id', '=', 'd.client_id')
                ->leftJoin('release as r', 'r.release_id', '=', 'b.release_id')
                ->leftJoin('client as rc', 'rc.client_id', '=', 'r.client_id')
                ->leftJoin('hospital as h', 'h.hospital_id', '=', 'r.hospital_id')
                ->where('b.bloodstorage_id', $bloodstorageid)
                ->select('b.bloodstorage_id as bb', 'b.component as comp', 'dc.client_name as don', 'rc.client_name as rec', 'd.datedonated as dd', 'r.datereleased as dr', 'h.hospital_name as hosp', 'b.expirydate as exp', 'b.status as s')
                ->get();

    return view('bloodstorage_about', ['infos' => $infos]);
  }

	public function addBloodbag($donationID){
		//Generate ID prefixes
    	$plasma = 'PS-';
    	$platelets = 'PT-';
    	$whole = 'WB-';
        $red = 'RB-';

    	//Generate the unique time code
    	$timeID = date('YmdHis');

    	// Generate the whole bloodbag ID
    	$plasmaID = $plasma.$timeID;
    	$plateID = $platelets.$timeID;
    	$wholeID = $whole.$timeID;
        $redID = $red.$timeID;

    	// -- Add plasma
    	$supplyPlasma = new Bloodstorage;
    	$supplyPlasma->bloodstorage_id = $plasmaID;
    	$supplyPlasma->donation_id = $donationID;
    	$supplyPlasma->component = 'PLASMA';
    	//Save data
    	$supplyPlasma->save();

    	// -- Add whole blood
    	$supplyWhole = new Bloodstorage;
    	$supplyWhole->bloodstorage_id = $wholeID;
    	$supplyWhole->donation_id = $donationID;
    	$supplyWhole->component = 'WHOLE BLOOD';
    	//Save data
    	$supplyWhole->save();

    	// -- Add platelets
    	$supplyPlate = new Bloodstorage;
    	$supplyPlate->bloodstorage_id = $plateID;
    	$supplyPlate->donation_id = $donationID;
    	$supplyPlate->component = 'PLATELETS';
    	//Save data
    	$supplyPlate->save();

        // -- Add whole blood
        $supplyRed = new Bloodstorage;
        $supplyRed->bloodstorage_id = $redID;
        $supplyRed->donation_id = $donationID;
        $supplyRed->component = 'RED BLOOD CELLS';
        //Save data
        $supplyRed->save();

    	return redirect()->route("donations")->with('alert-success', 'Blood successfully donated!');
	}

    public function viewInventory(){
    	$bloodbags = Bloodstorage::join('donation', 'bloodstorage.donation_id', '=', 'donation.donation_id')
    				->join('client', 'donation.client_id', '=', 'client.client_id')
    				->where('client.client_type', 'DONOR')
            ->orderBy('bloodstorage.status')
            ->orderBy('donation.datedonated', 'DESC')->paginate(15);
    	return view ('bloodstorage', ['bloodbags' => $bloodbags]);
    }

    public function showQuantityInput($releaseID){
        // Get recipient's bloodtype
        // Get the recipient's ID first
        $recipients = Release::join('client', 'client.client_id', '=', 'release.client_id')
                    ->where('release.release_id', $releaseID)->get();
        // Then get its bloodtype
        foreach ($recipients as $recipient) {
            $bloodtype = $recipient->client_bloodtype;
        }

        // Show available stocks based on blood type and blood component
        switch ($bloodtype) {
            case 'A+':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-');
                       })
                       
                       ->count();
                break;
            case 'A-':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-');
                       })
                       
                       ->count();
                break;
            case 'B+':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-');
                       })
                       
                       ->count();
                break;
            case 'B-':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-');
                       })
                       
                       ->count();
                break;
            case 'AB+':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB+')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       
                       ->count();
                break;
            case 'AB-':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB+')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       
                       ->count();
                break;
            case 'O+':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })
                       
                       ->count();
                break;
            case 'O-':
                $countWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where('client.client_bloodtype', 'O-')
                       
                       ->count();
                $countRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where('client.client_bloodtype', 'O-')
                       
                       ->count();
                $countPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       
                       ->count();
                $countPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })
                       
                       ->count();
                break;
        }

        return view ('release_quantity', ['wholeCount' => $countWhole, 'rbcCount' => $countRed, 'plasmaCount' => $countPlasma, 'plateCount' => $countPlate, 'releaseID' => $releaseID]);
    }

    public function getQuantityInput(Request $request, $releaseID){
        $whole = $request->input('whole');
        $plasma = $request->input('plasma');
        $plate = $request->input('plate');
        $rbc = $request->input('rbc');

        // Get recipient's bloodtype
        // Get the recipient's ID first
        $recipients = Release::join('client', 'client.client_id', '=', 'release.client_id')
                    ->where('release.release_id', $releaseID)->get();
        // Then get its bloodtype
        foreach ($recipients as $recipient) {
            $bloodtype = $recipient->client_bloodtype;
        }

        switch ($bloodtype) {
            case 'A+':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'AB+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'AB+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-');
                       })
                       ->limit($plate)
                       ->get();
                break;
            case 'A-':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'A+')
                                  ->orWhere('client.client_bloodtype', 'A-');
                       })
                       ->limit($plate)
                       ->get();
                break;
            case 'B+':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-');
                       })
                       ->limit($plate)
                       ->get();
                break;
            case 'B-':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'B+')
                                  ->orWhere('client.client_bloodtype', 'B-');
                       })
                       ->limit($plate)
                       ->get();
                break;
            case 'AB+':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB+')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($plate)
                       ->get();
                break;
            case 'AB-':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'A-')
                                  ->orWhere('client.client_bloodtype', 'B-')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB-')
                                  ->orWhere('client.client_bloodtype', 'AB+');
                       })
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'AB+')
                                  ->orWhere('client.client_bloodtype', 'AB-');
                       })
                       ->limit($plate)
                       ->get();
                break;
            case 'O+':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })

                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })
                       ->limit($plate)
                       ->get();
                break;
            case 'O-':
                $selectWhole = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'WHOLE BLOOD')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where('client.client_bloodtype', 'O-')
                       ->limit($whole)
                       ->get();
                $selectRed = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'RED BLOOD CELLS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where('client.client_bloodtype', 'O-')
                       ->limit($rbc)
                       ->get();
                $selectPlasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLASMA')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->limit($plasma)
                       ->get();
                $selectPlate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                       ->join('client', 'client.client_id', '=', 'donation.client_id')
                       ->where('bloodstorage.component', 'PLATELETS')
                       ->orderBy('bloodstorage.bloodstorage_id')
                       ->where('bloodstorage.status', 'AVAILABLE')
                       ->where(function ($query){
                            $query->where('client.client_bloodtype', 'O+')
                                  ->orWhere('client.client_bloodtype', 'O-');
                       })
                       ->limit($plate)
                       ->get();
                break;
        }
        
        // For each whole blood selected, update status to released
        foreach ($selectWhole as $wholes){
            $wholes->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
        }
        // For each RBC's selected, update
        foreach ($selectRed as $reds){
            $reds->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
        }
        // For each plasma selected, update
        foreach ($selectPlasma as $plasma){
            $plasma->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
        }
        // For each platelets selected, update
        foreach ($selectPlate as $plates){
            $plates->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
        }

        if ($selectWhole->count()==0 && $selectRed->count()==0 && $selectPlasma->count()==0 && $selectPlate->count()==0)
        {
          $maxid = Release::max('release_id');
          Release::where('release_id', $maxid)->delete();

          return redirect()->route('releases')->with('alert-info', 'No bloodbags were released because no quantities were provided.');
        }
         else {
    // For each whole blood selected, update status to released
            foreach ($selectWhole as $wholes){
                $wholes->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
            }
            // For each RBC's selected, update
            foreach ($selectRed as $reds){
                $reds->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
            }
            // For each plasma selected, update
            foreach ($selectPlasma as $plasma){
                $plasma->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
            }
            // For each platelets selected, update
            foreach ($selectPlate as $plates){
                $plates->update(['status' => 'RELEASED', 'release_id' => $releaseID]);
            }

            return redirect()->route('releases')->with('alert-success', 'Blood successfully released to patient');
         }
    }

    public function cancelRelease(){
        $maxid = Release::max('release_id');
        Release::where('release_id', $maxid)->delete();

        $backtoreleases = new ReleaseController;
        return $backtoreleases->viewReleases();
    }
}
