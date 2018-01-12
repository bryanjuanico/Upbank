@extends('layouts.clients_top')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Success</div>
                <div class="panel-body">
                    You have successfully updated client information.<br>
                    Click <a href="{{url('/clients_donors')}}">here</a> to go back to the list of donors.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
