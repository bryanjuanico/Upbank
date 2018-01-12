@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:red"><h3>All Donors</h3></div>
                <div class="panel-heading" style="text-align:center;background-color:red"><h3>Recent Donations<h3></div>
                <div class="panel-body">
                    <br>
                    <table border="1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td><b>Bloodbag ID</b></td>
                                <td><b>Donated By</b></td>
                                <td><b>Donated Component</b></td>
                                <td><b>Date Donated</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>
                                    <td>{{ $donation->bloodstorage_id }}</td>
                                    <td>{{ $donation->client_name }}</td>
                                    <td>{{ $donation->component }}</td>
                                    <td>{{ $donation->datedonated }}</td>
                                </button>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
