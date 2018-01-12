@extends('layouts.appsuperadmin')

@section('content')
<style>
    input[type="radio"]{
      margin: 10px 5px;
    }
</style>

<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add a Hospital</div>
                <div class="panel-body">
                    Hospitals are not updatable nor deletable, please provide correct info about a transfusing hospital.<br><br>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('hospital_added') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="hName" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="hName" type="text" class="form-control" name="hName" value="{{ old('hName') }}" required autofocus>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Hospital
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection