@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:red"><h3>Blood Storage Inventory<h3></div>
                <div class="panel-body">
                    <h4><b>Current Stocks</b> (<b><span style="color: green">Available</span></b>/<b><span style="color: blue">Released</span></b>/<b><span style="color: red">Expired</span></b>)</h4>

                    <b>Whole Blood</b>: <span style="color: green; text-align:left">{{$bloodbags->where('status', 'AVAILABLE')->where('component', 'WHOLE BLOOD')->count()}}</span>/<span style="color: blue">{{$bloodbags->where('status', 'RELEASED')->where('component', 'WHOLE BLOOD')->count()}}</span>/<span style="color: red">{{$bloodbags->where('status', 'EXPIRED')->where('component', 'WHOLE BLOOD')->count()}}</span><br>

                    <b>Red Blood Cells</b>: <span style="color: green; text-align:center">{{$bloodbags->where('status', 'AVAILABLE')->where('component', 'RED BLOOD CELLS')->count()}}</span>/<span style="color: blue">{{$bloodbags->where('status', 'RELEASED')->where('component', 'RED BLOOD CELLS')->count()}}</span>/<span style="color: red">{{$bloodbags->where('status', 'EXPIRED')->where('component', 'RED BLOOD CELLS')->count()}}</span><br>

                    <b>Fresh Frozen Plasma</b>: <span style="color: green; text-align:right">{{$bloodbags->where('status', 'AVAILABLE')->where('component', 'PLASMA')->count()}}</span>/<span style="color: blue">{{$bloodbags->where('status', 'RELEASED')->where('component', 'PLASMA')->count()}}</span>/<span style="color: red">{{$bloodbags->where('status', 'EXPIRED')->where('component', 'PLASMA')->count()}}</span><br>

                    <b>Platelets</b>: <span style="color: green">{{$bloodbags->where('status', 'AVAILABLE')->where('component', 'PLATELETS')->count()}}</span>/<span style="color: blue">{{$bloodbags->where('status', 'RELEASED')->where('component', 'PLATELETS')->count()}}</span>/<span style="color: red">{{$bloodbags->where('status', 'EXPIRED')->where('component', 'PLATELETS')->count()}}</span><br><br>

                    <b>TOTAL: </b>{{$bloodbags->total()}}

                    <table border="1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td><b>Bloodbag ID</b></td>
                                <td><b>Blood Type</b></td>
                                <td><b>Component</b></td>
                                <td><b>Status</b></td>
                                <td><b>Expiry Date and Time</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bloodbags as $bloodbag)
                                <tr>
                                    <td><a href="{{url('bloodstorage/'.$bloodbag->bloodstorage_id)}}">{{ $bloodbag->bloodstorage_id }}</a></td>
                                    <td>{{ $bloodbag->client_bloodtype }}</td>
                                    <td>{{ $bloodbag->component }}</td>
                                    <td>{{ $bloodbag->status }}</td>
                                    <td>{{ $bloodbag->expirydate }}</td>
                                </button>
                            @endforeach
                        </tbody>
                    </table>
                    {{$bloodbags->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
