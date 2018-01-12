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
                <div class="panel-heading" style="text-align:center;background-color:red"><h3>Recent Donations</h3></div>
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
                    To donate blood from a donor, please click Donate Blood.
                    <a href="{{url('donate/choose_donor')}}" style="float:right" role="button" class="btn btn-primary">Donate Blood</a>
                    <hr>
                    <br>

                    <table border="1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td><b>Date Donated</b></td>
                                <td><b>Donor</b></td>
                                <td><b>In-charge of Donation</b></td>
                                <td><b>Action</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->datedonated }}</td>
                                    <td>{{ $donation->client_name }}</td>
                                    <td>{{ $donation->name }}</td>
                                    <td><a href="{{url('donation/'.$donation->donation_id)}}"><button class="btn btn-primary">View</button></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$donations->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
