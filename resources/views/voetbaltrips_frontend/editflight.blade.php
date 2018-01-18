@extends('newtemplate/layout')

@section('header_styles')


    <style>
        /*********************************************
        Call Bootstrap
        *********************************************/

        @import asset("assets/css/frontend/bootstrap.min.css");
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
    </style>
@stop

@section('content')

    <!-- About -->
    <section id="" class="">

        <div class="content-wrapper edit-flight">
            <div class="container">
                <div class="row">
                    <form name="searchform" id="searchform" method="POST" novalidate>
                        <div class="col-md-2">
                            <select class="form-control" id="from" name="from">
                                <option value="">From</option>
                                @foreach($airports as $key=>$air_val)
                                    <option value="{!! $air_val->id !!}" {{ (($departure_flight->from == $air_val->id) ? 'selected="selected"':"")}}> &nbsp;{!! $air_val->title !!}&nbsp;</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="to" id="to">
                                <option value="">To</option>
                                @foreach($airports as $key=>$air_val)
                                    <option value="{!! $air_val->id !!}" {{ (($arrival_flight->from == $air_val->id) ? 'selected="selected"':"")}}> &nbsp;{!! $air_val->title !!}&nbsp;</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                        <span class="form-group">
                            <div class="input-group date match_date" data-date="" data-date-format="dd MM yyyy" data-link-field="flightdate" data-link-format="yyyy-mm-dd">
                                <input class="form-control" placeholder="Departure Date" size="16" type="text" value="" readonly />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="flightdate" name="flightdate" value="" /><br/>
                        </span>
                        </div>
                        <div class="col-md-3">
                    <span class="form-group">
                        <div class="input-group date todate" data-date="" data-date-format="dd MM yyyy" data-link-field="todate" data-link-format="yyyy-mm-dd">
                            <input class="form-control" placeholder="Return Date" size="16" type="text" value="" readonly />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        <input type="hidden" id="todate" name="todate" value="" /><br/>
                    </span>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="button" id="btnsearch">Search</button>
                        </div>
                        {{ csrf_field() }}
                        <input type="hidden" name="edit" id="edit" value="yes" />
                        <input type="hidden" name="match_id" id="match_id" value="{{$match_id}}">
                    </form>
                </div>
                <div class="row">
                    <form name="frmflightdetails" id="frmflightdetails" method="post" action="{{ url('flightsave/'.$match_id) }}">
                        <input type="hidden" name="match_id" id="match_id" value="{{$match_id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="edit" id="edit" value="yes" />
                        <div class="col-md-6">
                            <div class="product-title">Outgoing Flight</div>
                            <div class="" id="outgoing_Data">
                                
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="product-title">Return Flight</div>
                            <div class="" id="to_data">
                            </div>
                            <hr>
                        </div>
                    </form>
                </div>
                <div class="btn-group cart" style="float: right">
                    <button type="button" class="btn btn-success" name="addflighttocart" id="addflighttocart">Volgende/Next</button>
                </div>
            </div>
        </div>
        @section('footer_scripts')
            <link href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
            <script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/voetbaltrips_frontend/js/flights.js') }}"></script>
        @stop

    </section>



@stop