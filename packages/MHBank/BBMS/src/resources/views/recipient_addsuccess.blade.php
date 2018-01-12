@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Success</div>
                <div class="panel-body">
                    You have successfully added a new client. Click "Add a Client" again to add a new one. <br>
                    Or click <a href="{{url('/clients_recipients')}}">here</a> to go back to the list of clients.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection