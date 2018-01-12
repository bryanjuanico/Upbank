@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Clients</div>
                <div class="panel-body">
                    Please click on the ID number to view a client's profile.<br>
                    <table border="1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td><b>ID</b></td>
                                <td><b>Type</b></td>
                                <td><b>Name</b></td>
                                <td><b>Blood Type</b></td>
                                <td><b>Gender</b></td>
                                <td><b>Action</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td><a href="client/about/{{ $client->client_id }}">{{ $client->client_id }}</a></td>
                                    <td>{{ $client->client_type }}</td>
                                    <td>{{ $client->client_name }}</td>
                                    <td>{{ $client->client_bloodtype }}</td>
                                    <td>{{ $client->client_gender }}</td>
                                    <td><form action="client/update/{{$client->client_id}}"><button type="submit" class="btn btn-primary">Edit</form></td>
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
