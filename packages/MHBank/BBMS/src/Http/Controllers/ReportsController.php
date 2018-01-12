<?php

namespace MHBank\BBMS\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Bloodstorage;
use App\Models\Release;
use App\Models\Donation;

class ReportsController extends Controller
{
    public function basicReports(){
    	$numDonors = Client::where('client_type', 'DONOR')->count();
    	$numRecs = Client::where('client_type', 'RECIPIENT')->count();
    	$maleDonors = Client::where('client_type', 'DONOR')->where('client_gender', 'MALE')->count();
    	$femaleDonors = Client::where('client_type', 'DONOR')->where('client_gender', 'FEMALE')->count();
    	$maleRecs = Client::where('client_type', 'RECIPIENT')->where('client_gender', 'MALE')->count();
    	$femaleRecs = Client::where('client_type', 'RECIPIENT')->where('client_gender', 'FEMALE')->count();
    	$totalMale = Client::where('client_gender', 'MALE')->count();
    	$totalFemale = Client::where('client_gender', 'FEMALE')->count();
    	$grandTotal = Client::count();

    	$aplusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'A+')->count();
    	$aminusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'A-')->count();
    	$bplusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'B+')->count();
    	$bminusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'B-')->count();
    	$abplusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'AB+')->count();
    	$abminusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'AB-')->count();
    	$oplusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'O+')->count();
    	$ominusDonors = Client::where('client_type', 'DONOR')->where('client_bloodtype', 'O-')->count();
    	$aplusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'A+')->count();
    	$aminusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'A-')->count();
    	$bplusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'B+')->count();
    	$bminusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'B-')->count();
    	$abplusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'AB+')->count();
    	$abminusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'AB-')->count();
    	$oplusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'O+')->count();
    	$ominusRecs = Client::where('client_type', 'RECIPIENT')->where('client_bloodtype', 'O-')->count();
    	$aplusTotal = Client::where('client_bloodtype', 'A+')->count();
    	$aminusTotal = Client::where('client_bloodtype', 'A-')->count();
    	$bplusTotal = Client::where('client_bloodtype', 'B+')->count();
    	$bminusTotal = Client::where('client_bloodtype', 'B-')->count();
    	$abplusTotal = Client::where('client_bloodtype', 'AB+')->count();
    	$abminusTotal = Client::where('client_bloodtype', 'AB-')->count();
    	$oplusTotal = Client::where('client_bloodtype', 'O+')->count();
    	$ominusTotal = Client::where('client_bloodtype', 'O-')->count();

    	$donations = Donation::count();
    	$releases = Release::count();

    	$donwb = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
    						  ->where('bloodstorage.component','WHOLE BLOOD')->count();
    	$donplasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
    						  ->where('bloodstorage.component','PLASMA')->count();
    	$donplate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
    						  ->where('bloodstorage.component','PLATELETS')->count();
    	$donrbc = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')
    						  ->where('bloodstorage.component','RED BLOOD CELLS')->count();
    	$relwb = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')
    						  ->where('bloodstorage.component','WHOLE BLOOD')->count();
    	$relplasma = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')
    						  ->where('bloodstorage.component','PLASMA')->count();
    	$relplate = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')
    						  ->where('bloodstorage.component','PLATELETS')->count();
    	$relrbc = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')
    						  ->where('bloodstorage.component','RED BLOOD CELLS')->count();

    	$awb = Bloodstorage::where('status', 'AVAILABLE')->where('bloodstorage.component','WHOLE BLOOD')->count();
    	$aplasma = Bloodstorage::where('status', 'AVAILABLE')->where('bloodstorage.component','PLASMA')->count();
    	$aplate = Bloodstorage::where('status', 'AVAILABLE')->where('bloodstorage.component','PLATELETS')->count();
    	$arbc = Bloodstorage::where('status', 'AVAILABLE')->where('bloodstorage.component','RED BLOOD CELLS')->count();
    	$ewb = Bloodstorage::where('status', 'EXPIRED')->where('bloodstorage.component','WHOLE BLOOD')->count();
    	$eplasma = Bloodstorage::where('status', 'EXPIRED')->where('bloodstorage.component','PLASMA')->count();
    	$eplate = Bloodstorage::where('status', 'EXPIRED')->where('bloodstorage.component','PLATELETS')->count();
    	$erbc = Bloodstorage::where('status', 'EXPIRED')->where('bloodstorage.component','RED BLOOD CELLS')->count();

    	$totalinventory = Bloodstorage::count();
    	
    	return view ('reports', ['d'=>$numDonors, 'r'=>$numRecs, 'md'=>$maleDonors, 'fd'=>$femaleDonors, 'mr'=>$maleRecs, 'fr'=>$femaleRecs, 'tm'=>$totalMale, 'tf'=>$totalFemale, 'gt'=>$grandTotal, 'apd'=>$aplusDonors, 'apr'=>$aplusRecs, 'bpd'=>$bplusDonors, 'bpr'=>$bplusRecs, 'abpd'=>$abplusDonors, 'abpr'=>$abplusRecs, 'opd'=>$oplusDonors, 'opr'=>$oplusRecs, 'amd'=>$aminusDonors, 'amr'=>$aminusRecs, 'bmd'=>$bminusDonors, 'bmr'=>$bminusRecs, 'abmd'=>$abminusDonors, 'abmr'=>$abminusRecs, 'omd'=>$ominusDonors, 'omr'=>$ominusRecs, 'apt'=>$aplusTotal, 'bpt'=>$bplusTotal,  'abpt'=>$abplusTotal,  'opt'=>$oplusTotal, 'amt'=>$aminusTotal, 'bmt'=>$bminusTotal,  'abmt'=>$abminusTotal, 'omt'=>$ominusTotal, 'don'=>$donations, 'rel'=>$releases, 'dwb'=>$donwb, 'dplasma'=>$donplasma, 'dplate'=>$donplate, 'drbc'=>$donrbc, 'rwb'=>$relwb, 'rplasma'=>$relplasma, 'rplate'=>$relplate, 'rrbc'=>$relrbc, 'awb'=>$awb, 'aplasma'=>$aplasma, 'aplate'=>$aplate, 'arbc'=>$arbc, 'ewb'=>$ewb, 'eplasma'=>$eplasma, 'eplate'=>$eplate, 'erbc'=>$erbc, 'tot'=>$totalinventory]);
    }

    public function periodicReports(Request $request){
        $from = $request->input('datefrom');
        $to = $request->input('dateto');

        $numDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->get(['client.client_id'])->count();
        $numRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client_type', 'RECIPIENT')->get(['client.client_id'])->count();

        $maleDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client_gender', 'MALE')->get(['client.client_id'])->count();
        $femaleDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client_gender', 'FEMALE')->get(['client.client_id'])->count();

        $maleRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client_gender', 'MALE')->get(['client.client_id'])->count();
        $femaleRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client_gender', 'FEMALE')->get(['client.client_id'])->count();

        $totalMale = $maleDonors+$maleRecs;
        $totalFemale = $femaleRecs+$femaleDonors;
        $grandTotal = $totalMale+$totalFemale;

        $aplusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'A+')->get(['client.client_id'])->count();
        $aminusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'A-')->get(['client.client_id'])->count();
        $bplusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'B+')->get(['client.client_id'])->count();
        $bminusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'B-')->get(['client.client_id'])->count();
        $abplusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'AB+')->get(['client.client_id'])->count();
        $abminusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'AB-')->get(['client.client_id'])->count();
        $oplusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'O+')->get(['client.client_id'])->count();
        $ominusDonors = Client::distinct()->join('donation', 'donation.client_id','=', 'client.client_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)->where('client.client_type', 'DONOR')->where('client.client_bloodtype', 'O-')->get(['client.client_id'])->count();

        $aplusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'A+')->get(['client.client_id'])->count();
        $aminusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'A-')->get(['client.client_id'])->count();
        $bplusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'B+')->get(['client.client_id'])->count();
        $bminusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'B-')->get(['client.client_id'])->count();
        $abplusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'AB+')->get(['client.client_id'])->count();
        $abminusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'AB-')->get(['client.client_id'])->count();
        $oplusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'O+')->get(['client.client_id'])->count();
        $ominusRecs = Client::distinct()->join('release', 'release.client_id','=', 'release.client_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)->where('client.client_type', 'RECIPIENT')->where('client.client_type', 'RECIPIENT')->where('client.client_bloodtype', 'O-')->get(['client.client_id'])->count();

        $aplusTotal = $aplusRecs+$aplusDonors;
        $aminusTotal = $aminusRecs+$aminusDonors;
        $bplusTotal = $bplusRecs+$bplusDonors;
        $bminusTotal = $bminusRecs+$bminusDonors;
        $abplusTotal = $abplusRecs+$abplusDonors;
        $abminusTotal = $abminusRecs+$abminusDonors;
        $oplusTotal = $oplusRecs+$oplusDonors;
        $ominusTotal = $ominusRecs+$ominusDonors;

        $donations = Donation::where('datedonated', '>=', $from)->where('datedonated', '<=', $to)->count();
        $releases = Release::where('datereleased', '>=', $from)->where('datereleased', '<=', $to)->count();

        $donwb = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)
                              ->where('bloodstorage.component','WHOLE BLOOD')->count();
        $donplasma = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)
                              ->where('bloodstorage.component','PLASMA')->count();
        $donplate = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)
                              ->where('bloodstorage.component','PLATELETS')->count();
        $donrbc = Bloodstorage::join('donation', 'donation.donation_id', '=', 'bloodstorage.donation_id')->where('donation.datedonated', '>=', $from)->where('donation.datedonated', '<=', $to)
                              ->where('bloodstorage.component','RED BLOOD CELLS')->count();
        $relwb = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)
                              ->where('bloodstorage.component','WHOLE BLOOD')->count();
        $relplasma = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)
                              ->where('bloodstorage.component','PLASMA')->count();
        $relplate = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)
                              ->where('bloodstorage.component','PLATELETS')->count();
        $relrbc = Bloodstorage::join('release', 'release.release_id', '=', 'bloodstorage.release_id')->where('release.datereleased', '>=', $from)->where('release.datereleased', '<=', $to)
                              ->where('bloodstorage.component','RED BLOOD CELLS')->count();

        $b1620d = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','16')
                           ->where('client.client_age', '<=','20')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b2125d = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','21')
                           ->where('client.client_age', '<=','25')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b2630d = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','26')
                           ->where('client.client_age', '<=','30')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b3135d = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','31')
                           ->where('client.client_age', '<=','35')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b3640d = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','36')
                           ->where('client.client_age', '<=','40')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b4145d = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','41')
                           ->where('client.client_age', '<=','45')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b4650d = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','46')
                           ->where('client.client_age', '<=','50')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b50plusd = Donation::distinct()->join('client', 'client.client_id','=','donation.client_id')
                           ->where('client.client_age','>=','51')
                           ->where('donation.datedonated', '>=', $from)
                           ->where('donation.datedonated', '<=', $to)
                           ->get(['client.client_id'])->count();


        $b1620r = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','16')
                           ->where('client.client_age', '<=','20')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b2125r = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','21')
                           ->where('client.client_age', '<=','25')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b2630r = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','26')
                           ->where('client.client_age', '<=','30')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b3135r = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','31')
                           ->where('client.client_age', '<=','35')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b3640r = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','36')
                           ->where('client.client_age', '<=','40')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b4145r = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','41')
                           ->where('client.client_age', '<=','45')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b4650r = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','46')
                           ->where('client.client_age', '<=','50')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();
        $b50plusr = Release::distinct()->join('client', 'client.client_id','=','release.client_id')
                           ->where('client.client_age','>=','51')
                           ->where('release.datereleased', '>=', $from)
                           ->where('release.datereleased', '<=', $to)
                           ->get(['client.client_id'])->count();

        $b1620t = $b1620r+$b1620d;
        $b2125t = $b2125r+$b2125d;
        $b2630t = $b2630r+$b2630d;
        $b3135t = $b3135r+$b3135d;
        $b3640t = $b3640r+$b3640d;
        $b4145t = $b4145r+$b4145d;
        $b4650t = $b4650r+$b4650d;
        $b50plust = $b50plusr+$b50plusd;

        return view ('reports_periodic', ['from'=>$from, 'to'=>$to, 'd'=>$numDonors, 'r'=>$numRecs, 'md'=>$maleDonors, 'fd'=>$femaleDonors, 'mr'=>$maleRecs, 'fr'=>$femaleRecs, 'tm'=>$totalMale, 'tf'=>$totalFemale, 'gt'=>$grandTotal, 'apd'=>$aplusDonors, 'apr'=>$aplusRecs, 'bpd'=>$bplusDonors, 'bpr'=>$bplusRecs, 'abpd'=>$abplusDonors, 'abpr'=>$abplusRecs, 'opd'=>$oplusDonors, 'opr'=>$oplusRecs, 'amd'=>$aminusDonors, 'amr'=>$aminusRecs, 'bmd'=>$bminusDonors, 'bmr'=>$bminusRecs, 'abmd'=>$abminusDonors, 'abmr'=>$abminusRecs, 'omd'=>$ominusDonors, 'omr'=>$ominusRecs, 'apt'=>$aplusTotal, 'bpt'=>$bplusTotal,  'abpt'=>$abplusTotal,  'opt'=>$oplusTotal, 'amt'=>$aminusTotal, 'bmt'=>$bminusTotal,  'abmt'=>$abminusTotal, 'omt'=>$ominusTotal, 'don'=>$donations, 'rel'=>$releases, 'dwb'=>$donwb, 'dplasma'=>$donplasma, 'dplate'=>$donplate, 'drbc'=>$donrbc, 'rwb'=>$relwb, 'rplasma'=>$relplasma, 'rplate'=>$relplate, 'rrbc'=>$relrbc, 'b1620d' => $b1620d, 'b2125d' => $b2125d, 'b2630d' => $b2630d, 'b3135d' => $b3135d, 'b3640d' => $b3640d, 'b4145d' => $b4145d, 'b4650d' => $b4650d, 'b50plusd' => $b50plusd, 'b1620r' => $b1620r, 'b2125r' => $b2125r, 'b2630r' => $b2630r, 'b3135r' => $b3135r, 'b3640r' => $b3640r, 'b4145r' => $b4145r, 'b4650r' => $b4650r, 'b50plusr' => $b50plusr, 'b1620t' => $b1620t, 'b2125t' => $b2125t, 'b2630t' => $b2630t, 'b3135t' => $b3135t, 'b3640t' => $b3640t, 'b4145t' => $b4145t, 'b4650t' => $b4650t, 'b50plust' => $b50plust]);
    }
}
