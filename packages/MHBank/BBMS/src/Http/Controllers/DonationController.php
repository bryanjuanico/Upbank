<?php

namespace MHBank\BBMS\Http\Controllers;
use App\Models\Donation;
use App\Models\Client;
use App\Models\Bloodstorage;
use App\Models\Release;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function showDonations () {
    	$donations = Donation::join('client', 'donation.client_id', '=', 'client.client_id')
                    ->join('users', 'donation.id', '=', 'users.id')
    				->where('client.client_type', 'DONOR')
    				->select('users.name', 'donation.donation_id', 'client.client_name', 'donation.datedonated')->orderBy('donation.datedonated', 'desc')->paginate(15);
    	return view ('donations', ['donations' => $donations]);
    }

    

    public function apply(Request $request){
        $donors = (new Donation)->select(DB::raw('distinct on(client.client_id) client.client_id, client.client_name, client.client_bloodtype, donation.datedonated'))
                           ->orderBy('client.client_id', 'asc')
                           ->where('client.client_type', 'DONOR')
                           ->orderBy('donation.datedonated', 'desc')->rightJoin('client', 'donation.client_id', '=', 'client.client_id')->newQuery();

         if ($request->has('namesearch')) {
            $donors->where('client.client_name','ilike', '%'.$request->input('namesearch').'%');
         }


         if ($request->has('groupsearch')) {
            
            if ($request->has('rhsearch')){
                $donors->where('client.client_bloodtype', 'like', $request->input('groupsearch').$request->input('rhsearch'));
            } else {
                $donors->where('client.client_bloodtype', 'like', $request->input('groupsearch').'_');
            }
         }

        return $donors->orderBy('donation_id')->paginate(15);
    }

    public function filter(Request $request){
        $donors = DonationController::apply($request);
        return view('choose_donor', ['donors'=>$donors]);
    }

    public function chooseDonor() {
    	$donors = DB::table('donation')->select(DB::raw('distinct on(client.client_id) client.client_id, client.client_name, client.client_bloodtype, donation.datedonated', 'donation.donation_id'))
                           ->orderBy('client.client_id', 'asc')
                           ->rightJoin('client', 'donation.client_id', '=', 'client.client_id')
                           ->where('client.client_type', 'DONOR')
                           ->orderBy('donation.datedonated', 'desc')
                           ->orderBy('donation.donation_id')->get();
        return view ('choose_donor', ['donors' => $donors]);
    }

    public function createDonation($clientID) {
    	$donate = new Donation;
    	$donate->client_id = $clientID;
    	$donate->datedonated = date("Y-m-d H:i:s");

        // Gets the user ID of the current user
        $userid = Auth::user()->id;

        $donate->id = $userid;
    	$donate->save();
        
    	$donID = $donate->max('donation_id');

    	$supply = new BloodstorageController;
    	return $supply->addBloodbag($donID);
    }

    public function viewDonation($donationid){
        $donated = Donation::join('bloodstorage', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                           ->join('users', 'users.id', '=', 'donation.id')
                           ->join('client as dc', 'donation.client_id','=','dc.client_id')
                           ->leftJoin('release', 'release.release_id', '=', 'bloodstorage.release_id')
                           ->leftJoin('client as rc', 'release.client_id', '=', 'rc.client_id')
                           ->where('donation.donation_id', $donationid)
                           ->select('rc.client_name as r', 'dc.client_name as d', 'release.*', 'donation.*', 'bloodstorage.*', 'users.*')
                           ->get();
        return view('donation_about', ['donated' => $donated]);
    }
}
