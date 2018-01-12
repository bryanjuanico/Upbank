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
                <div class="panel-heading">Add a Client</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('client/recipient_added') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="bloodtype" class="col-md-4 control-label">Blood Type</label>

                            <div class="col-md-6">
                                <input id="group" type="radio" class="form-horizontal" name="group" value="A" required autofocus> A
                                <input id="group" type="radio" class="form-horizontal" name="group" value="B" required autofocus> B
                                <input id="group" type="radio" class="form-horizontal" name="group" value="AB" required autofocus> AB
                                <input id="group" type="radio" class="form-horizontal" name="group" value="O" required autofocus> O
                                &nbsp;&nbsp;&nbsp;
                                <select name="rh" class="form-horizontal">
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <input id="gender" type="radio" name="gender" class="form-horizontal"  value="MALE" required autofocus> Male
                                <input id="gender" type="radio" name="gender" class="form-horizontal" value="FEMALE" required autofocus> Female
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dob" class="col-md-4 control-label">Date of Birth</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telephone" class="col-md-4 control-label">Telephone Number</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Recipient
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