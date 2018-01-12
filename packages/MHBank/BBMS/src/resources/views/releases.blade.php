@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:red"><h3>All Releases</h3></div>
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
                    To release blood to a recipient, please click Release Blood.
                    <a href="{{url('release/choose_recipient')}}" style="float:right" role="button" class="btn btn-primary">Release Blood</a>
                    <hr>
                    <table border="1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td><b>Date and Time Released</b></td>
                                <td><b>Recipient</b></td>
                                <td><b>Transfusing Hospital</b></td>
                                <td><b>Action</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($releases as $release)
                                <tr>
                                    <td>{{ $release->datereleased }}</td>
                                    <td>{{ $release->client_name }}</td>
                                    <td>{{ $release->hospital_name }}</td>
                                    <td><form action="{{url('release/about/'.$release->release_id)}}"><button class="btn btn-primary">Details</button></form></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
