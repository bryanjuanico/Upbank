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
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Blood Bank Reports and Figures</b><br>As of {{date('F j, Y')}}</div>
                <div class="panel-body">
                    <a href="#" id="periodic" style="float:left">Advanced Donor Search</a>
                    <h3><b>Clients</b></h3>
                    Clients are the donors and the recipients of blood components. As of the development now, two instances of a client is made if he/she is both a donor and a recipient.
                    <h4>Clients By Gender</h4>
                    <table border="1" class="table table-striped table-bordered">
                            <thead align="center">
                                <tr>
                                    <td><b>Gender \ Type</b></td>
                                    <td><b>Donors</b></td>
                                    <td><b>Recipients</b></td>
                                    <td><b><i>Total</i></b></td>
                                </tr>
                            </thead>

                            <tbody align="center">
                                    <tr>
                                        <td><b>Male</b></td>
                                        <td>{{$md}}</td>
                                        <td>{{$mr}}</td>
                                        <td>{{$tm}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Female</b></td>
                                        <td>{{$fd}}</td>
                                        <td>{{$fr}}</td>
                                        <td>{{$tf}}</td>
                                    </tr>
                                    <tr>
                                       <td><b><i>Total</i></b></td>
                                        <td>{{$d}}</td>
                                        <td>{{$r}}</td>
                                        <td><b>{{$gt}}</b></td> 
                                    </tr>
                            </tbody>
                    </table>
                    <br>
                    <h4>Clients By Blood Group</h4>
                     <table border="1" class="table table-striped table-bordered">
                            <thead align="center">
                                <tr>
                                    <td><b>Client Type \ Blood Type</b></td>
                                    <td><b>A+</b></td>
                                    <td><b>A-</b></td>
                                    <td><b>B+</b></td>
                                    <td><b>B-</b></td>
                                    <td><b>AB+</b></td>
                                    <td><b>AB-</b></td>
                                    <td><b>O+</b></td>
                                    <td><b>O-</b></td>
                                    <td><b><i>Total</i></b></td>
                                </tr>
                            </thead>

                            <tbody align="center">
                                    <tr>
                                        <td><b>Donors</b></td>
                                        <td>{{$apd}}</td>
                                        <td>{{$amd}}</td>
                                        <td>{{$bpd}}</td>
                                        <td>{{$bmd}}</td>
                                        <td>{{$abpd}}</td>
                                        <td>{{$abmd}}</td>
                                        <td>{{$opd}}</td>
                                        <td>{{$omd}}</td>
                                        <td>{{$d}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Recipients</b></td>
                                        <td>{{$apr}}</td>
                                        <td>{{$amr}}</td>
                                        <td>{{$bpr}}</td>
                                        <td>{{$bmr}}</td>
                                        <td>{{$abpr}}</td>
                                        <td>{{$abmr}}</td>
                                        <td>{{$opr}}</td>
                                        <td>{{$omr}}</td>
                                        <td>{{$r}}</td>
                                    </tr>
                                    <tr>
                                       <td><b><i>Total</i></b></td>
                                        <td>{{$apt}}</td>
                                        <td>{{$amt}}</td>
                                        <td>{{$bpt}}</td>
                                        <td>{{$bmt}}</td>
                                        <td>{{$abpt}}</td>
                                        <td>{{$abmt}}</td>
                                        <td>{{$opt}}</td>
                                        <td>{{$omt}}</td>
                                        <td><b>{{$gt}}</b></td>
                                    </tr>
                            </tbody>
                    </table>
                    <br>
                    <h3><b>Blood Bank Inventory</b></h3>
                    <h4>Blood Storage</h4>
                    Bloodbags Donated: <b>{{$tot}}</b>
                    <table border="1" class="table table-striped table-bordered">
                            <thead align="center">
                                <tr>
                                    <td><b>Status \ Component</b></td>
                                    <td><b>Whole Blood</b></td>
                                    <td><b>Plasma</b></td>
                                    <td><b>Platelets</b></td>
                                    <td><b>Red Blood Cells</b></td>
                                </tr>
                            </thead>

                            <tbody align="center">
                                    <tr>
                                        <td><b><span style="color: green">Available</span></b></td>
                                        <td>{{$awb}}</td>
                                        <td>{{$aplasma}}</td>
                                        <td>{{$aplate}}</td>
                                        <td>{{$arbc}}</td>
                                    </tr>
                                    <tr>
                                        <td><b><span style="color: blue">Released</span></b></td>
                                        <td>{{$rwb}}</td>
                                        <td>{{$rplasma}}</td>
                                        <td>{{$rplate}}</td>
                                        <td>{{$rrbc}}</td>
                                    </tr>
                                    <tr>
                                        <td><b><span style="color: red">Expired</span></b></td>
                                        <td>{{$ewb}}</td>
                                        <td>{{$eplasma}}</td>
                                        <td>{{$eplate}}</td>
                                        <td>{{$erbc}}</td>
                                    </tr>
                            </tbody>
                    </table>
                    <div id="myModal" class="modal">
                          <!-- Modal content -->
                          <div class="modal-content">
                                <span class="close">x</span>
                                <h4><b>Generate Periodic Reports</b></h4>
                                <form class="form-horizontal" role="form" method="GET" action="{{ url('reports_periodic') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="datefrom" class="col-md-4 control-label">From</label>

                            <div class="col-md-6">
                                <input id="datefrom" type="date" class="form-control" name="datefrom" value="{{ old('datefrom') }}" required autofocus>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="dateto" class="col-md-4 control-label">To</label>

                            <div class="col-md-6">
                                <input id="dateto" type="date" class="form-control" name="dateto" value="{{ old('dateto') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Generate
                                </button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                    <script>
                        // Get the modals
                        var modal = document.getElementById('myModal');
                        // Get the button that opens the modal
                        var btn = document.getElementById("periodic");

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
