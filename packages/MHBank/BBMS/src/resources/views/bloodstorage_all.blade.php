@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center"><h3>Blood Storage Inventory</h3></div>
                <div class="panel-body" style="text-align:center">
                    Available: <b><span style="color: green">{{$bloodbags->where('status', 'AVAILABLE')->count()}} </span></b>&nbsp;&nbsp;&nbsp;
                    Released: <b><span style="color: blue">{{$bloodbags->where('status', 'RELEASED')->count()}} </span></b>&nbsp;&nbsp;&nbsp;
                    Expired: <b><span style="color: red">{{$bloodbags->where('status', 'EXPIRED')->count()}}</span></b>&nbsp;&nbsp;&nbsp;
                    Total: <b><span>{{$bloodbags->count()}}</span></b>&nbsp;&nbsp;&nbsp;
                    <hr>
                    
                    <table border="1" class="table table-striped table-bordered" >
                        <thead style="background-color:red;color:white">
                            <tr>
                                <td><b>Bloodbag ID</b></td>
                                <td><b>Blood Type</b></td>
                                <td><b>Donated Component</b></td>
                                <td><b>Status</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bloodbags as $bloodbag)
                                <tr>
                                    <td>{{ $bloodbag->bloodstorage_id }}</td>
                                    <td>{{ $bloodbag->client_bloodtype }}</td>
                                    <td>{{ $bloodbag->component }}</td>
                                    <td>{{ $bloodbag->status }}</td>
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
