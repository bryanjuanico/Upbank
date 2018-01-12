@extends('layouts.appsuperadmin')

@section('content')
<div class="container" style="width:125%;margin-left:-180px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Blood Bag Information</b></div>
                <div class="panel-body">
                    <h4>Unique ID: <b>{{ $infos[0]->bb }}</b></h4>
                    <h2>Contents</h2>
                    <h4>Component: <b>{{ $infos[0]->comp }}</b></h4>
                    <h4>Expiry Date: <b>{{ $infos[0]->exp }}</b></h4>
                    <h2>Interactions</h2>
                    <h4>Status: <b>@if($infos[0]->s == 'AVAILABLE')
                                        <span style="color: green">AVAILABLE</span>
                                        (Expires in {{floor((strtotime($infos[0]->exp)-strtotime(date('Y-m-d H:i:s')))/(60*60*24))}} days)
                                        @elseif($infos[0]->s == 'RELEASED')
                                        <span style="color: blue">RELEASED</span>
                                        @elseif($infos[0]->s == 'EXPIRED')
                                        <span style="color: red">EXPIRED</span>
                                        @endif</b></h4>
                    <table id='donorstable' border="1" class="table table-striped table-bordered">
                        <tr class="header">
                                <th><b>Date Donated</b></th>
                                <th><b>Donated By</b></th>
                                <th><b>Date Released</b></th>
                                <th><b>Released To</b></th>
                                <th><b>Transfusing Hospital</b></th>
                        </tr>

                        <tbody>
                                <tr>
                                    <td>{{$infos[0]->dd}}</td>
                                    <td>{{$infos[0]->don}}</td>
                                    @if($infos[0]->s == 'AVAILABLE')
                                        <td align='center' colspan='3'>NOT YET RELEASED</td>
                                    @elseif($infos[0]->s == 'EXPIRED')
                                        <td align='center' colspan='3'>UNRELEASED</td>
                                    @else
                                        <td>{{$infos[0]->dr}}</td>
                                        <td>{{$infos[0]->rec}}</td>
                                        <td>{{$infos[0]->hosp}}</td>
                                    @endif
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection