@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Success</div>
                <div class="panel-body">
                    You have successfully donated from this donor. Every blood donor is a hero! <br>
                    Click "Donate Blood" again to donate from a donor. <br>
                    Click <a href="{{url('/donations')}}">here</a> to go back to the list of donations.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
