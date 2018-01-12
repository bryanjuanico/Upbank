<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Bloodstorage;
use App\Models\Release;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function viewClientsDonor() {
    	$clients = Client::where('client_type', 'DONOR')->select('client_id', 'client_type', 'client_name', 'client_bloodtype', 'client_gender')->orderBy('client_name')->paginate(10);
    	return view ('clients_donors', ['clients' => $clients]);
    }

    public function viewClientsRecipient() {
        $clients = Client::where('client_type', 'RECIPIENT')->select('client_id', 'client_type', 'client_name', 'client_bloodtype', 'client_gender')->orderBy('client_name')->paginate(10);
        return view ('clients_recipients', ['clients' => $clients]);
    }

    public function applyDonors(Request $request){
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

         if ($request->has('gendersearch')) {
            $clients->where('client_gender','like', $request->input('gendersearch'));
         }

        return $clients->where('client_type', 'DONOR')->paginate(10);
    }

    public function filterDonors(Request $request){
        $clients = ClientController::applyDonors($request);
        return view('clients_donors', ['clients'=>$clients]);
    }

    public function applyRecipients(Request $request){
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

         if ($request->has('gendersearch')) {
            $clients->where('client_gender','like', $request->input('gendersearch'));
         }

        return $clients->where('client_type', 'RECIPIENT')->paginate(10);
    }

    public function filterRecipients(Request $request){
        $clients = ClientController::applyRecipients($request);
        return view('clients_recipients', ['clients'=>$clients]);
    }

    public function showClient ($id) {
        $selectClient = new Client;

        $client = $selectClient->where('client_id', $id)->get();

        $donations = Bloodstorage::leftJoin('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
                                 ->leftJoin('client AS d', 'd.client_id', '=', 'donation.client_id')
                                 ->leftJoin('release', 'release.release_id', '=', 'bloodstorage.release_id')
                                 ->leftJoin('client AS r', 'release.client_id', '=', 'r.client_id')
                                 ->where('donation.client_id', $id)
                                 ->select('donation.datedonated AS dd','bloodstorage.component AS com','r.client_name AS rec', 'release.datereleased AS rd')
                                 ->orderBy('donation.datedonated', 'desc')->get();

        $lastDonation = DB::table('client')->select(DB::raw('distinct on(client.client_id) client.client_id, client.client_name, client.client_bloodtype, donation.datedonated'))
                           ->orderBy('client.client_id', 'asc')
                           ->leftJoin('donation', 'donation.client_id', '=', 'client.client_id')
                           ->where('client.client_type', 'DONOR')
                           ->where('donation.client_id', $id)
                           ->orderBy('donation.datedonated', 'desc')
                           ->first();

        $countDonations = Client::find($id)->donations->count();

        $releases = Release::join('bloodstorage', 'bloodstorage.release_id', '=', 'release.release_id')
                           ->join('hospital', 'hospital.hospital_id', '=', 'release.hospital_id')
                           ->join('client AS r', 'r.client_id', '=', 'release.client_id')
                           ->join('donation', 'bloodstorage.donation_id', '=', 'donation.donation_id')
                           ->join('client AS d', 'd.client_id', '=', 'donation.client_id')
                           ->where('release.client_id', $id)
                           ->select('release.datereleased AS rd', 'release.diagnosis AS diag', 'd.client_name AS don', 'hospital.hospital_name AS h', 'bloodstorage.component AS com')
                           ->orderBy('release.datereleased', 'desc')->get();

        return view ('client_about',['clients' => $client,'countDonations' => $countDonations, 'donations' => $donations, 'releases' => $releases, 'lastDonation' => $lastDonation]);
    }

    public function getInputDonor(Request $request) {
    	$name = $request->input('name');

    	$bgroup = $request->input('group');
    	$rhfactor = $request->input('rh');
    	$btype = $bgroup.$rhfactor;

    	$gender = $request->input('gender');
    	$dob = $request->input('dob');
    	$address = $request->input('address');
    	$mobnum = $request->input('mobile');
    	$telnum = $request->input('telephone');
    	$email = $request->input('email');

    	$newClient = new Client;
    	$newClient->client_type = 'DONOR';
    	$newClient->client_name = $name;
    	$newClient->client_bloodtype = $btype;
    	$newClient->client_address = $address;
    	$newClient->client_gender = $gender;
    	$newClient->client_dob = $dob;
    	$newClient->mobile = $mobnum;
    	$newClient->telephone = $telnum;
    	$newClient->email = $email;

    	$newClient->save();

    	$request->session()->flash('alert-success', 'Donor was successfully added.');
        return redirect()->route("donors");
    }

    public function getInputRecipient(Request $request) {
        $name = $request->input('name');

        $bgroup = $request->input('group');
        $rhfactor = $request->input('rh');
        $btype = $bgroup.$rhfactor;

        $gender = $request->input('gender');
        $dob = $request->input('dob');
        $address = $request->input('address');
        $mobnum = $request->input('mobile');
        $telnum = $request->input('telephone');
        $email = $request->input('email');

        $newClient = new Client;
        $newClient->client_type = 'RECIPIENT';
        $newClient->client_name = $name;
        $newClient->client_bloodtype = $btype;
        $newClient->client_address = $address;
        $newClient->client_gender = $gender;
        $newClient->client_dob = $dob;
        $newClient->mobile = $mobnum;
        $newClient->telephone = $telnum;
        $newClient->email = $email;

        $newClient->save();

        $request->session()->flash('alert-success', 'Recipient was successfully added.');
        return redirect()->route("recipients");
    }

    public function showUpdateForm ($clientID) {
        $selectClient = new Client;

        $client = $selectClient->where('client_id', $clientID)->get();
        return view ('client_updateform',['clients' => $client]);
    }

    public function editClient(Request $request, $clientID) {
        $newAddress = $request->input('add');
        $newMobile = $request->input('mob');
        $newTel = $request->input('tel');
        $newEmail = $request->input('mail');

        $edit = new Client;
          
        if (!empty($newAddress)){
            $edit->where('client_id', $clientID)->update(['client_address' => $newAddress]);
        }

        if (!empty($newMobile)){
            $edit->where('client_id', $clientID)->update(['mobile' => $newMobile]);
        }

        if (!empty($newTel)){
            $edit->where('client_id', $clientID)->update(['telephone' => $newTel]);
        }

        if (!empty($newEmail)){
            $edit->where('client_id', $clientID)->update(['email' => $newEmail]);
        }

        $type = Client::where('client_id', $clientID)->select('client_type')->get();

        if (empty($newAddress) && empty($newMobile) && empty($newTel) && empty($newEmail))
            return redirect()->route('client_about', [$clientID])->with('alert-info', 'Update form left blank. Client info was not updated.');
        else {
            if ($type[0]->client_type == 'DONOR')
                return redirect()->route('client_about', [$clientID])->with('alert-success', 'Donor successfully updated.');
            else if ($type[0]->client_type == 'RECIPIENT')
                return redirect()->route('client_about', [$clientID])->with('alert-success', 'Recipient successfully updated.');
        }
        
    }
}
