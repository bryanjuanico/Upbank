@extends('layouts.appsuperadmin')

@section('content')
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>{{$clients[0]->client_name}}</b> ({{$clients[0]->client_type}})</div>
                <div class="panel-body">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
                          <p class="alert alert-{{ $msg }}">

                            @if ($msg == 'danger')
                                <strong>ERROR! </strong>
                            @elseif ($msg == 'warning')
                                <strong>WARNING! </strong>
                            @elseif ($msg == 'info')
                                <strong>Notice:</strong>
                            @elseif ($msg == 'success')
                                <strong>SUCCESS! </strong>
                            @endif

                            {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                          @endif
                        @endforeach
                    </div>
                    <h4>Bloodtype: <b>{{$clients[0]->client_bloodtype}}</b></h4>
                    <h4>Gender: <b>{{$clients[0]->client_gender}}</b></h4>
                    <h4>Date of Birth: <b>{{$clients[0]->client_dob}}</b>   (age: <b>{{$clients[0]->client_age}}</b>) </h4>
                    <h4>Address: <b>{{$clients[0]->client_address}}</b></h4>
                    <h4>Mobile Number: <b>{{$clients[0]->mobile}}</b></h4>
                    <h4>Telephone Number: <b>{{$clients[0]->telephone}}</b></h4>
                    <h4>E-Mail Address: <b>{{$clients[0]->email}}</b></h4>
                    <button type="submit" id="updateinfo" class="btn btn-primary"> Update Client Info
                    </button><br><br>
                    <div id="myModal" class="modal">

                          <!-- Modal content -->
                          <div class="modal-content">
                                <span class="close">x</span>
                                <h4><b>Update Info</b></h4><br>
                                    <form class="form-horizontal" role="form" method="POST" action="{{$clients[0]->client_id}}/success">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="add" class="col-md-4 control-label">New Address</label>

                            <div class="col-md-6">
                                <input id="add" type="text" class="form-control" name="add" placeholder="{{$clients[0]->client_address}}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mob" class="col-md-4 control-label">New Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mob" type="text" class="form-control" name="mob" placeholder="{{$clients[0]->mobile}}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tel" class="col-md-4 control-label">New Telephone Number</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" placeholder="{{$clients[0]->telephone}}"  autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mail" class="col-md-4 control-label">New E-mail Address</label>

                            <div class="col-md-6">
                                <input id="mail" type="text" class="form-control" name="mail" placeholder="{{$clients[0]->email}}"  autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Info
                                </button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>

                    @if($clients[0]->client_type == 'DONOR')
                        <h4><b>History of Donations</b></h4>
                        Number of Times Donated: <b>{{$countDonations}}</b><br>
                        Date and Time Last Donated: <b>
                            @if (is_null($lastDonation))
                                Donor has not donated yet
                            @else
                                {{ date('F j, Y', strtotime($lastDonation->datedonated)).'  '.date('g:i:sA', strtotime($lastDonation->datedonated)) }}
                            @endif
                        </b><br>
                        Can donate again in: <b>
                            @if (is_null($lastDonation))
                                Anytime
                            @else
                                 @php
                                    echo date_format(date_add(date_create($lastDonation->datedonated), date_interval_create_from_date_string('56 days')), 'F j, Y');
                                 @endphp
                            @endif
                        </b><br><br>
                        <table border="1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td><b>Date Donated</b></td>
                                    <td><b>Component</b></td>
                                    <td><b>Released To</b></td>
                                    <td><b>Date Released</b></td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($donations as $donation)
                                    <tr>
                                        <td>{{ $donation->dd }}</td>
                                        <td>{{ $donation->com }}</td>
                                        <td>{{ $donation->rec }}</td>
                                        <td>{{ $donation->rd }}</td>
                                    </button>
                                @endforeach
                            </tbody>
                        </table>
                    @elseif ($clients[0]->client_type == 'RECIPIENT')
                        <h4><b>History of Blood Release to Recipient</b></h4>
                        
                        <table border="1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td><b>Date Released</b></td>
                                    <td><b>Diagnosis</b></td>
                                    <td><b>Component</b></td>
                                    <td><b>Donated By</b></td>
                                    <td><b>Transfusing Hospital</b></td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($releases as $release)
                                    <tr>
                                        <td>{{ $release->rd }}</td>
                                        <td>{{ $release->diag }}</td>
                                        <td>{{ $release->com }}</td>
                                        <td>{{ $release->don }}</td>
                                        <td>{{ $release->h }}</td>
                                    </button>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <script>
                        // Get the modals
                        var modal = document.getElementById('myModal');
                        // Get the button that opens the modal
                        var btn = document.getElementById("updateinfo");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];
                        // When the user clicks the button, open the modal 

                        btn.onclick = function() {
                            modal.style.display = "block";
                        }
                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                            modal.style.display = "none";
                        }

                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
