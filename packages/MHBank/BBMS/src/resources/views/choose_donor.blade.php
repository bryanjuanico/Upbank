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
        width: 50%;
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
                <div class="panel-heading">Available Donors</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                    <div class="form-group">
                            <label for="search" class="col-md-4 control-label">Search Donor </label>

                            <div class="col-md-6">
                                <input id="search" type="text" class="form-control" value="{{ old('search') }}" onkeyup="myFunction()" placeholder="For quick donations, search for a donor">
                             </div>
                     </div>
                    </form>
                    
                    Please click on Donate button to donate blood from that donor.<br>
                    <a href="#" id="advanced" style="float:right">Advanced Donor Search</a>
                    Click on the ID number to view a client's profile.<br><br>
                    <div id="myModal" class="modal">

                          <!-- Modal content -->
                          <div class="modal-content">
                                <span class="close">x</span>
                                <h4><b>Advanced Donor Search</b></h4>
                                <form class="form-horizontal" role="form" method="GET" action="{{ url('donate/choose_donor') }}">
                            <div class="form-group">
                                <label for="namesearch" class="col-md-4 control-label">Search for donors named</label>

                                <div class="col-md-6">
                                    <input id="namesearch" placeholder="Enter a name here" type="text" class="form-control" name="namesearch" value="{{ old('namesearch') }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="groupsearch" class="col-md-4 control-label">and/or those who have blood type</label>

                                <div class="col-md-6">
                                    <input id="groupsearch" type="radio" class="form-horizontal" name="groupsearch" value="A" autofocus> A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input id="groupsearch" type="radio" class="form-horizontal" name="groupsearch" value="B" autofocus> B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input id="groupsearch" type="radio" class="form-horizontal" name="groupsearch" value="AB" autofocus> AB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input id="groupsearch" type="radio" class="form-horizontal" name="groupsearch" value="O" autofocus> O
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <select name="rhsearch" class="form-horizontal" style="width: 50px">
                                        <option value="+"><b>+</b></option>
                                        <option value="-"><b>-</b></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gendersearch" class="col-md-4 control-label">and/or those who are</label>

                                <div class="col-md-6">
                                    <input id="gendersearch" type="radio" name="gendersearch" class="form-horizontal"  value="MALE" autofocus> Male
                                    <input id="gendersearch" type="radio" name="gendersearch" class="form-horizontal" value="FEMALE" autofocus> Female
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                          </div>

                    </div>
                    <br>
                    <table id='donorstable' border="1" class="table table-striped table-bordered">
                            <tr class="header">
                                <th><b>ID</b></th>
                                <th><b>Name</b></th>
                                <th><b>Blood Type</b></th>
                                <th><b>Last Donated</b></th>
                                <th><b>Action</b></th>
                            </tr>
                        <tbody>
                            @foreach ($donors as $donor)
                                <tr>
                                    <td><a href="/client/about/{{ $donor->client_id }}">{{ $donor->client_id }}</a></td>
                                    <td>{{ $donor->client_name }}</td>
                                    <td>{{ $donor->client_bloodtype }}</td>
                                    <td>{{ $donor->datedonated }}</td>
                                    <td><form action="/donate/{{$donor->client_id}}">
                                        @if (date_add(date_create($donor->datedonated), date_interval_create_from_date_string('56 days')) <= date('Y-m-d H:i:s') || $donor->datedonated == null)
                                            <button type="submit" id="donatebutton" class="btn btn-primary">Donate</form></td>
                                        @else
                                            <button type="submit" id="cannotdonate" disabled title="Days left before next donation: {{floor((strtotime(date_format(date_add(date_create($donor->datedonated), date_interval_create_from_date_string('56 days')),'Y-m-d H:i:s')) - strtotime(date('Y-m-d H:i:s'))) / (60 * 60 * 24))}} days
                                                " class="btn btn-primary">Donate</form></td>
                                        @endif
                                </button>
                            @endforeach
                        </tbody>
                    </table>
                    {{$donors->links()}}
                    <script>
                        function myFunction() {
                          var input, filter, table, tr, td, i;
                          input = document.getElementById("search");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("donorstable");
                          tr = table.getElementsByTagName("tr");

                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[1];
                            if (td) {
                              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                              } else {
                                tr[i].style.display = "none";
                              }
                            } 
                          }
                        }
                    </script>
                    <script>
                        // Get the modals
                        var modal = document.getElementById('myModal');
                        // Get the button that opens the modal
                        var btn = document.getElementById("advanced");

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
