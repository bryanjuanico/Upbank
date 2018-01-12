@extends('layouts.appsuperadmin')

@section('content')
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Hospitals</div>
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
                    Please click on the ID number to view a hospital's profile.
                    <button id='addhospital' class="btn btn-primary" style="float:right">Add a Hospital</button>
                    <div id="myModal" class="modal">
                          <!-- Modal content -->
                          <div class="modal-content">
                                <span class="close">x</span>
                                <h4><b>Add a Hospital</b></h4>
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
                    <br><br>
                    <table border="1" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td><b>ID</b></td>
                                <td><b>Name</b></td>
                                <td><b>Location</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hospitals as $hospital)
                                <tr>
                                    <td>{{ $hospital->hospital_id }}</td>
                                    <td>{{ $hospital->hospital_name }}</td>
                                    <td>{{ $hospital->location }}</td>
                                </button>
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        // Get the modals
                        var modal = document.getElementById('myModal');
                        // Get the button that opens the modal
                        var btn = document.getElementById("addhospital");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];
                        // When the user clicks the button, open the modal 

                        btn.onclick = function() {
                            modal.style.display = "block";
                        }
                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                            modal.style.display = "none";
                        }
                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
