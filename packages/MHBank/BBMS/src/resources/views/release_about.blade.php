@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Blood Donation Information</b></div>
                <div class="panel-body">
                    
                    <h4>Release Date: <b>{{$released[0]->datedonated}}</b></h4>
                    <h4>Recipient <b>{{$released[0]->r}}</b></h4>
                    <h4>In-charge of Release: <b>{{$released[0]->name}}</b></h4>

                    <h4><b>Released Components</b></h4>
                    <table border="1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td><b>Blood Bag ID</b></td>
                                    <td><b>Component</b></td>
                                    <td><b>Date Donated</b></td>
                                    <td><b>Donated By</b></td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($released as $release)
                                    <tr>
                                        <td>{{ $release->bloodstorage_id }}</td>
                                        <td>{{ $release->component }}</td>
                                        <td>{{ $release->datedonated}}</td>
                                        <td>{{ $release->d }}</td>
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