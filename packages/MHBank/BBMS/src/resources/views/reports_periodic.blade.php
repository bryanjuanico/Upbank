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
                <div class="panel-heading"><b>Iligan City Red Cross Blood Services Reports and Figures</b><br>From {{$from}} to {{$to}}</div>
                <div class="panel-body">
                    <a href="#" id="periodic">Generate Periodic Reports</a>
                    <input type="button" onclick="window.print()" value="Print Generated Reports" class="btn btn-primary" style="float: right">
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
                    <h4>Clients By Age Range</h4>
                    <table border="1" class="table table-striped table-bordered">
                        <thead align="center">
                                <tr>
                                    <td><b>Age Range (y.o.) \ Client Type</b></td>
                                    <td><b>Donors</b></td>
                                    <td><b>Recipients</b></td>
                                    <td><b><i>Total</i></b></td>
                                </tr>
                            </thead>

                            <tbody align="center">
                                    <tr>
                                        <td><b>16-20 y.o.</b></td>
                                        <td>{{$b1620d}}</td>
                                        <td>{{$b1620r}}</td>
                                        <td>{{$b1620t}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>21-25 y.o.</b></td>
                                        <td>{{$b2125d}}</td>
                                        <td>{{$b2125r}}</td>
                                        <td>{{$b2125t}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>26-30 y.o.</b></td>
                                        <td>{{$b2630d}}</td>
                                        <td>{{$b2630r}}</td>
                                        <td>{{$b2630t}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>31-35 y.o.</b></td>
                                        <td>{{$b3135d}}</td>
                                        <td>{{$b3135r}}</td>
                                        <td>{{$b3135t}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>36-40 y.o.</b></td>
                                        <td>{{$b3640d}}</td>
                                        <td>{{$b3640r}}</td>
                                        <td>{{$b3640t}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>41-45 y.o.</b></td>
                                        <td>{{$b4145d}}</td>
                                        <td>{{$b4145r}}</td>
                                        <td>{{$b4145t}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>46-50 y.o.</b></td>
                                        <td>{{$b4650d}}</td>
                                        <td>{{$b4650r}}</td>
                                        <td>{{$b4650t}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>51 y.o. and above</b></td>
                                        <td>{{$b50plusd}}</td>
                                        <td>{{$b50plusr}}</td>
                                        <td>{{$b50plust}}</td>
                                    </tr>
                                    <tr>
                                        <td><b><i>Total</i></b></td>
                                        <td>{{$d}}</td>
                                        <td>{{$b1620r+$b2125r+$b2630r+$b3135r+$b3640r+$b4145r+$b4650r+$b50plusr}}</td>
                                        <td><b>{{$d+$b1620r+$b2125r+$b2630r+$b3135r+$b3640r+$b4145r+$b4650r+$b50plusr}}</b></td>
                                    </tr>
                            </tbody>
                    </table>
                    <br>
                    <h4>Donated and Released Blood Components</h4>
                     <table border="1" class="table table-striped table-bordered">
                            <thead align="center">
                                <tr>
                                    <td><b>Component \ Transaction</b></td>
                                    <td><b>Whole Blood</b></td>
                                    <td><b>Red Blood Cells</b></td>
                                    <td><b>Plasma</b></td>
                                    <td><b>Platelets</b></td>
                                    <td><b><i>Total</i></b></td>
                                </tr>
                            </thead>

                            <tbody align="center">
                                    <tr>
                                        <td><b>Donated</b></td>
                                        <td>{{$dwb}}</td>
                                        <td>{{$drbc}}</td>
                                        <td>{{$dplasma}}</td>
                                        <td>{{$dplate}}</td>
                                        <td>{{$dwb+$drbc+$dplasma+$dplate}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Released</b></td>
                                        <td>{{$rwb}}</td>
                                        <td>{{$rrbc}}</td>
                                        <td>{{$rplasma}}</td>
                                        <td>{{$rplate}}</td>
                                        <td>{{$rwb+$rrbc+$rplasma+$rplate}}</td>
                                    </tr>
                                    <tr>
                                        <td><b><i>Total</i></b></td>
                                        <td>{{$dwb+$rwb}}</td>
                                        <td>{{$drbc+$rrbc}}</td>
                                        <td>{{$dplasma+$rplasma}}</td>
                                        <td>{{$dplate+$rplate}}</td>
                                        <td><b>{{$dwb+$drbc+$dplasma+$dplate+$rwb+$rrbc+$rplasma+$rplate}}</b></td>
                                    </tr>
                            </tbody>
                    </table>
                    <div id="myModal" class="modal">

                          <!-- Modal content -->
                          <div class="modal-content">
                                <span class="close">x</span>
                                <h4><b>Generate Periodic Reports</b></h4>
                                <form class="form-horizontal" role="form" method="GET" action="{{ url('reports/periodic') }}">
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
                        // Get the modal
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
