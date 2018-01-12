@extends('layouts.clients_top')

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
                <div class="panel-heading">Update {{$clients[0]->client_name}}</div>
                <div class="panel-body">
                    For changes in name, gender, and/or birthdate, please contact us.<br>
                    This page only modifies changeable details.<br>
                    <span style="color: red">You cannot update a donor to be a recipient. A new client must be created.</span><br><br>

                    <form class="form-horizontal" role="form" method="POST" action="{{$clients[0]->client_id}}/success">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="add" class="col-md-4 control-label">New Address</label>

                            <div class="col-md-6">
                                <input id="add" type="text" class="form-control" name="add" value="{{$clients[0]->client_address}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mob" class="col-md-4 control-label">New Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mob" type="text" class="form-control" name="mob" value="{{$clients[0]->mobile}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tel" class="col-md-4 control-label">New Telephone Number</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" value="{{$clients[0]->telephone}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mail" class="col-md-4 control-label">New E-mail Address</label>

                            <div class="col-md-6">
                                <input id="mail" type="text" class="form-control" name="mail" value="{{$clients[0]->email}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Info
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