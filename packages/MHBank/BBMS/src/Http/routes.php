<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('homepage');
});


Auth::routes();

Route::get('/Band', function() {
	return view('Band');
});

Route::get('/managestaff', function(){
	echo 'You have access';
})->middleware('superadmin');

Route::group(['middleware' => ['auth']], function(){

	

	Route::get('profile', 'UserController@profile');

	Route::post('profile', 'UserController@update_avatar');

	Route::get('clients_donors', 'ClientController@viewClientsDonor')->name('donors');

	Route::get('clients_recipients', 'ClientController@viewClientsRecipient')->name('recipients');

	Route::get('clients/donor_add', 'ClientController@createDonor');

	Route::get('clients_donors/search', 'ClientController@filterDonors');

	Route::get('clients_recipients/search', 'ClientController@filterRecipients');

	Route::post('client/donor_added', 'ClientController@getInputDonor');

	Route::get('clients/recipient_add', 'ClientController@createRecipient');

	Route::post('client/recipient_added', 'ClientController@getInputRecipient');

	Route::get('client/about/{clientID}', 'ClientController@showClient')->name('client_about');

	Route::get('client/update/{clientID}', 'ClientController@showUpdateForm');

	Route::post('client/about/{clientID}/success', 'ClientController@editClient');

	Route::get('donations', 'DonationController@showDonations')->name('donations');

	Route::get('donation/{donationID}', 'DonationController@viewDonation');

	Route::get('donate/choose_donor', 'DonationController@chooseDonor');

	Route::get('donate/choose_donor', 'DonationController@filter');

	Route::get('donate/{clientID}', 'DonationController@createDonation');

	Route::get('inventory', 'BloodstorageController@viewInventory');

	Route::get('hospitals', 'HospitalController@viewHospitals')->name('hospitals');

	Route::get('hospitals/add', 'HospitalController@createHospital');

	Route::post('hospital_added', 'HospitalController@getInput');

	Route::get('releases', 'ReleaseController@viewReleases')->name('releases');

	Route::get('release/choose_recipient', 'ReleaseController@chooseRecipient');

	Route::get('release/{clientID}', 'ReleaseController@createRelease');

	Route::get('bloodstorage/{bloodstorageid}', 'BloodstorageController@showBloodbag');

	Route::get('release/choose_recipient', 'ReleaseController@filter');

	Route::post('release/{clientID}/quantity', 'ReleaseController@getInput');

	Route::get('release_blood/quantity', 'BloodstorageController@showQuantityInput');

	Route::post('blood_released/{releaseID}', 'BloodstorageController@getQuantityInput');

	Route::get('release/about/{releaseID}', 'ReleaseController@showRelease');

	Route::get('releases/all', 'BloodstorageController@cancelRelease');

	Route::get('/home', 'HomeController@index3');

	Route::get('/home-2', 'HomeController@index');	

	Route::get('/homepage', 'HomeController@index2');

	Route::get('/home/{name}', 'HomeControllerSuper@index3');

	Route::get('/dashboard', 'dashboardController@index');

	Route::get('reports', 'ReportsController@basicReports');

	Route::get('reports_periodic', 'ReportsController@periodicReports');
});
