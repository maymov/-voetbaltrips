@extends('newtemplate/layout')
@section('header_styles')

<style>
    /*********************************************
    Call Bootstrap
    *********************************************/
    .checkbox-custom, .checkbox-custom-label, .radio-custom, .radio-custom-label {
        display: inline-block;
        vertical-align: middle;
        margin: 5px;
        cursor: pointer;
    }

    .checkbox-custom-label, .radio-custom-label {
        position: relative;
    }
    .checkbox-custom {
        content: '';
        background: #fff;
        border: 2px solid #ddd;
        display: inline-block;
        vertical-align: middle;
        width: 20px;
        height: 20px;
        padding: 2px;
        margin-right: 10px;
        text-align: center;
    }
    .checkbox-custom:checked {
        content: "\f00c";
        font-family: 'FontAwesome';
        background: rebeccapurple;
        color: #fff;
    }
    input[type=checkbox] {
        margin: 10px;
    }
    #my-row{
        border-bottom: 1px solid #ddd;
    }
    .checktdrett, .checktddepart{
        background-color: #8fb9e8;
    }
    .table-bordered{
        border:none
    }
    .table-bordered >tbody > tr{
        cursor: pointer;
    }
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
        border-left: none;
        border-right: none;
    }
    .table-bordered > tbody > tr:last-child > td{
        border-bottom: none;
    }
    @media(max-width: 375px) {
        body{
            font-size: 12px;
        }
        .table.table-bordered {
            width: 100%;
        }
        .num-check {
           width: 5px !important;
            padding: 0px !important;
        }
        .td-data {
            width: 10px !important;
        }
        .checkbox-custom{
            width: 12px;
            height: 12px;
            padding: 0;
        }
        .product-title, .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
            font-size: 12px;
            max-width: 10px;
        }
        .product-title{
            padding-left: 0;
            min-width: 300px;
        }
        .table-bordered {
            width: 342px;
            min-width: 300px;
        }
        #outgoing_Data .product-title, #to_data .product-title, #outgoing_Data table, #to_data table {
             min-width: 300px;
        }
        .product-title a{
            font-size: 8px;
            margin-right: 5px;
            margin-left: 5px;
        }
        #earl_day_return, #latt_day_return{
            min-width: 0;
        }
        .table > tbody > tr > td{
            padding: 4px;
        }
    }
    @media(max-width: 320px) {
        .product-title{
            padding-left: 0;
            min-width: 300px;
        }
        .table-bordered {
            width: 260px;
            min-width: 200px;
        }
        #outgoing_Data .product-title, #to_data .product-title, #outgoing_Data table, #to_data table {
            min-width: 200px;
        }
    }

    @import asset("assets/css/frontend/bootstrap.min.css");
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");   
</style>
@stop

@section('content')
    <!-- About -->
    <section id="" class="">
        <div class="container">
            <div id="cart_content" class="cart_flightselection"></div>
        </div>
        <div class="content-wrapper flight-blade">
            <div class="container">
                <div class="row" id="my-row" >
                    <form name="searchform" id="searchform" method="POST" novalidate>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="product-description">{{Translater::getValue('form-title-select-airport-you-want-to-use-for-travel')}}</p>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($airports as $key=>$air_val)
                                    <div class="col-md-4">
                                        <label for="checkbox-{{$key}}" name="checkbox-{{$key}}" class="checkbox-custom-label">
                                            <input id="checkbox-{{$key}}" class="checkbox-custom" name="airports[]" type="checkbox" value="{!! $air_val->id !!}">
                                            {!! $air_val->title !!}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{ csrf_field() }}
                        <input type="hidden" name="match_id" id="match_id" value="{{$match_id}}">
                        <input type="hidden" name="airports" id="airports" value="">
                        <input type="hidden" name="day_mode" id="day_mode" value="">
                        <input type="hidden" name="day_val" id="day_val" value="">
                        <input type="hidden" name="day_form_out" id="day_form_out" value="">
                        <input type="hidden" name="day_form_ret" id="day_form_ret" value="">
                        <input type="hidden" name="screen_size" id="screen_size" value="">
                    </form>
                </div>
                <div class="row">
                    <form name="frmflightdetails" id="frmflightdetails" method="post" action="{{ url('flightsave/'.$match_id) }}">
                        <input type="hidden" name="match_id" id="match_id" value="{{$match_id}}">
                        {{ csrf_field() }}
                    <div class="col-lg-6">
                            <div class="" id="outgoing_Data"></div>
                            <hr>
                    </div>
                    <div class="col-lg-6">

                            <div class="" id="to_data">

                            </div>
                            <hr>
                        </div>
                    </form>
                </div>
                <div class="btn-group cart next-prev">
                    <a href="{{url("match/".$match_id)}}" class="btn btn-info btn-nm">
                        <span class="glyphicon glyphicon-backward"></span> {{Translater::getValue('button-back-to-tickets-page')}}
                    </a>
                    <button type="button" class="btn btn-success" name="addflighttocart" id="addflighttocart">{{Translater::getValue('button-next')}}</button>
                </div>
            </div>
        </div>
        <div class="item-container">
            <ul id="myTab" class="nav nav-tabs nav_tabs">
                <li class="active"><a href="#service-three" data-toggle="tab">{{strtoupper(Translater::getValue('label-match-description-small'))}}</a></li>
                <li><a href="#service-club" data-toggle="tab">{{strtoupper(Translater::getValue('form-label-club'))}}</a></li>
                <li><a href="#service-one" data-toggle="tab">{{strtoupper(Translater::getValue('label-stadion'))}}</a></li>
                <li><a href="#service-two" data-toggle="tab">{{strtoupper(Translater::getValue('label-tournament-small'))}}</a></li>
            </ul>
        </div>
        <div class="content-tabs">
            <div class="container">
			    <?php $city_n = '';?>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane tab-pane fade in active" id="service-three">
                        <section class="container">
                            <p style="padding-top: 10px;"> {{Translater::getValue('form-label-planned-on')}} : {{ date("d-m-Y", strtotime($match->match_date)) }} </p>
                            <p> {{Translater::getValue('form-label-match-time')}} : {{ date("H:i", strtotime($match->match_date)) }}</p>
                        </section>
                    </div>
                    <div class="tab-pane tab-pane fade" id="service-club">
                        <section class="container">
                            <h3>{{$match->getHomeClub->name}}</h3>
                            <p>{{Translater::getValue('form-label-club')}} {{Translater::getValue('label-story')}}:</p>
                            @foreach ($match->getHomeClub->getTranslate as $trans)
                                @if ($trans->lang_code == Session::get('lang_code'))
                                    <p>{{$trans->story}}</p>
                                @endif
                            @endforeach
                        </section>
                    </div>
                    <div class="tab-pane fade" id="service-one">
                        <section class="container">
                            {{--  Een geweldige wedstrijd--}}
                            <h3>{{$match->getStadium->stadium}}</h3>
                            <p>{{Translater::getValue('form-title-about-stadium')}}:</p>
                            @foreach ($match->getStadium->getTranslate as $trans)
                                @if ($trans->lang_code == Session::get('lang_code'))
                                    <p>{{$trans->story}}</p>
                                @endif
                            @endforeach
                        </section>
                    </div>
                    <div class="tab-pane tab-pane fade" id="service-two">
                        <section class="container">
                            <h3> {{ $match->getTournament->name }}</h3>
                            @foreach ($match->getTournament->getTranslate as $trans)
                                @if ($trans->lang_code == Session::get('lang_code'))
                                    <p> {{ $trans->story }} </p>
                                @endif
                            @endforeach
                        </section>
                    </div>

                </div>
            </div>
        </div>
        @section('footer_scripts')
            <script>
                var showText = '{{ $match->show_text }}';
                $('#screen_size').val(window.screen.width);
                {{--if (window.screen.width < 375) {--}}
                    {{--$('tbody tr th:nth-child(1)').hide();--}}
                    {{--$('tbody tr th:nth-child(2)').hide();--}}
                    {{--$('tr[name=return_flight_td] td:nth-child(1)').hide()--}}
                    {{--$('tr[name=return_flight_td] td:nth-child(2)').hide()--}}
                    {{--$('tr[name=dept_flight_td] td:nth-child(1)').hide()--}}
                    {{--$('tr[name=dept_flight_td] td:nth-child(2)').hide()--}}
                {{--}--}}
            </script>
            <link href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
            <script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/voetbaltrips_frontend/js/flights.js') }}"></script>
        @stop
        
    </section>
    @stop
