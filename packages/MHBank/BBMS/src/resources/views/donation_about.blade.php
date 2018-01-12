@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Blood Donation Information</b></div>
                <div class="panel-body">
                    
                    <h4>Donation Date: <b>{{$donated[0]->datedonated}}</b></h4>
                    <h4>Donor: <b>{{$donated[0]->d}}</b></h4>
                    <h4>In-charge of Donation: <b>{{$donated[0]->name}}</b></h4>

                    <h4><b>Donated Components</b></h4>
                    <table border="1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <td><b>Blood Bag ID</b></td>
                                    <td><b>Component</b></td>
                                    <td><b>Released To</b></td>
                                    <td><b>Date Released</b></td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($donated as $donate)
                                    <tr>
                                        <td>{{ $donate->bloodstorage_id }}</td>
                                        <td>{{ $donate->component }}</td>
                                        <td>{{ $donate->r}}</td>
                                        <td>{{ $donate->datereleased }}</td>
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