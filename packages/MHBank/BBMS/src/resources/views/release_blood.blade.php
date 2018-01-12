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
                <div class="panel-heading">Release Blood</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('release/'.$clientID.'/quantity') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="diagnosis" class="col-md-4 control-label">Diagnosis</label>

                            <div class="col-md-6">
                                <input id="diagnosis" type="text" class="form-control" name="diagnosis" value="{{ old('diagnosis') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="thospital" class="col-md-4 control-label">Transfusing Hospital</label>

                            <div class="col-md-6">
                                
                                <select class="form-horizontal" name="hospitalname">
                                @foreach ($hospitals as $hospital)
                                    <option value="{{$hospital->hospital_name}}">{{$hospital->hospital_name}}</option>
                                @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Proceed
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