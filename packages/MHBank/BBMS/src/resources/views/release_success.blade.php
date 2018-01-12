@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Success</div>
                <div class="panel-body">
                    You have successfully released blood to the recipient. <br>
                    Click "Release Blood" again to release blood bags from the bloodbank. <br>
                    Click <a href="{{url('releases')}}">here</a> to go back to the list of releases.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
