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

    .modal2 {
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
    .close2 {
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
    .close2:hover,
    .close2:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center"><h3>All Recipients</h3></div>
                <div class="panel-body" >
                    <form class="form-horizontal" role="form">
                    <div class="form-group">
                            <label for="search" class="col-md-4 control-label">Search Recipient </label>

                            <div class="col-md-6">
                                <input id="search" type="text" class="form-control" value="{{ old('search') }}" onkeyup="myFunction()">
                             </div>
                     </div>
                    </form><br>
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
                    <button id='addrecipient' class="btn btn-primary" style="float:left">Add a Recipient</button>
                    <a href="#" id="advanced" style="float:right">Advanced Recipient Search</a>
                    <br><br>
                    <div id="myModal" class="modal">
                          <!-- Modal content -->
                          <div class="modal-content">
                                <span class="close">x</span>
                                <h4><b>Add a Donor</b></h4>
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
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}"  autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telephone" class="col-md-4 control-label">Telephone Number</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"  autofocus>
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
                    <div id="myModal2" class="modal">

                          <!-- Modal content -->
                          <div class="modal-content">
                                <span class="close2">x</span>
                                <h4><b>Advanced Recipient Search</b></h4>
                                <form class="form-horizontal" role="form" method="GET" action="{{ url('clients_recipients/search') }}">
                            <div class="form-group">
                                <label for="namesearch" class="col-md-4 control-label">Search for recipients named</label>

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

                    Showing <b>{{($clients->currentpage()-1)*$clients->perpage()+1}}</b> to <b>{{(($clients->currentpage()-1)*$clients->perpage())+$clients->count()}}</b> of <b>{{$clients->total() }}</b> recipients
                    <table id="recipientstable" border="1" class="table table-striped table-bordered">
                        <tr class="header">
                                <th><b>ID</b></th>
                                <th><b>Name</b></th>
                                <th><b>Blood Type</b></th>
                                <th><b>Gender</b></th>
                                <th><b>Action</b></th>
                        </tr>

                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->client_id }}</td>
                                    <td>{{ $client->client_name }}</td>
                                    <td>{{ $client->client_bloodtype }}</td>
                                    <td>{{ $client->client_gender }}</td>
                                    <td><form action="{{url('client/about/'.$client->client_id)}}"><button type="submit" class="btn btn-primary">View</form></td>
                                </button>
                            @endforeach
                        </tbody>
                    </table>
                    {{$clients->links()}}
                    <script>
                        function myFunction() {
                          var input, filter, table, tr, td, i;
                          input = document.getElementById("search");
                          filter = input.value.toUpperCase();
                          table = document.getElementById("recipientstable");
                          tr = table.getElementsByTagName("tr");

                          for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[2];
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
                        var modal2 = document.getElementById('myModal2');
                        // Get the button that opens the modal
                        var btn = document.getElementById("addrecipient");
                        var btn2 = document.getElementById("advanced");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];
                        var span2 = document.getElementsByClassName("close2")[0];
                        // When the user clicks the button, open the modal 

                        btn.onclick = function() {
                            modal.style.display = "block";
                        }
                        btn2.onclick = function() {
                            modal2.style.display = "block";
                        }

                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                            modal.style.display = "none";
                        }
                        span2.onclick = function() {
                            modal2.style.display = "none";
                        }

                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                            if (event.target == modal2) {
                                modal2.style.display = "none";
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
