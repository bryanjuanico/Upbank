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
                <div class="panel-heading">Requested Quantities</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('blood_released/'.$releaseID) }}">
                        {{ csrf_field() }}
                        

                        <div class="form-group">
                            <label for="whole" class="col-md-4 control-label">Whole Blood<br>(Available stocks: {{ $wholeCount }})</label>

                            <div class="col-md-6">
                                <input id="whole" type="number" min="0" max="{{$wholeCount}}" class="form-control" name="whole" value="0" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="plasma" class="col-md-4 control-label">Fresh Frozen Plasma<br>(Available stocks: {{ $plasmaCount }})</label>

                            <div class="col-md-6">
                                <input id="plasma" type="number" min="0" max="{{$plasmaCount}}" class="form-control" name="plasma" value="0" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="plate" class="col-md-4 control-label">Platelets<br>(Available stocks: {{ $plateCount }})</label>

                            <div class="col-md-6">
                                <input id="plate" type="number" min="0" max="{{$plateCount}}" class="form-control" name="plate" value="0" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rbc" class="col-md-4 control-label">Red Blood Cells<br>(Available stocks: {{ $rbcCount }})</label>

                            <div class="col-md-6">
                                <input id="rbc" type="number" min="0" max="{{$rbcCount}}" class="form-control" name="rbc" value="0" required autofocus>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Release Bloodbags
                                </button>
                            </div>
                        </div>
                    </form>

                    <form class="form-horizontal" role="form" method="GET" action="{{ url('releases/all') }}">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="background-color: red">
                                    Cancel
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