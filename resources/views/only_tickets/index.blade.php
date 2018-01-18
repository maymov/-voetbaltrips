@extends('newtemplate/layout')

@section('header_styles')
    <style>
        .event-list {
            list-style: none;
            font-family: 'Lato', sans-serif;
            margin: 0px;
            padding: 0px;
        }
        .event-list > li {
            background-color: rgb(255, 255, 255);
            box-shadow: 0px 0px 5px rgb(51, 51, 51);
            box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
            padding: 0px;
            margin: 0px 0px 20px;
        }
        .event-list > li > time {
            display: inline-block;
            width: 100%;
            color: rgb(255, 255, 255);
            background-color: #acca5a;
            padding: 5px;
            text-align: center;
            text-transform: uppercase;
        }
        .event-list > li:nth-child(even) > time {
            background-color: #acca5a;
        }
        .event-list > li > time > span {
            display: none;
        }
        .event-list > li > time > .day {
            display: block;
            font-size: 56pt;
            font-weight: 100;
            line-height: 1;
        }
        .event-list > li time > .month {
            display: block;
            font-size: 24pt;
            font-weight: 900;
            line-height: 1;
        }
        .event-list > li > img {
            width: 100%;
        }
        .event-list > li > .info {
            padding-top: 5px;
            text-align: center;
        }
        .event-list > li > .info > #homeemblem {
            display: inline-block;
            float: left;
            line-height: 120px;
            height: 120px;
            width: 20%;
            padding: 20px 0;
        }
        .event-list > li > .info > #awayemblem {
            display: inline-block;
            float: right;
            line-height: 120px;
            height: 120px;
            width: 20%;
            padding: 20px 0;
        }

        .event-list > li > .info > .club-emblem {
            display: inline-block;
        }
        .event-list > li > .info > .club-emblem .title {
            font-size: 17pt;
            font-weight: 700;
            margin: 0px;
            padding-top: 14%;
        }
        .event-list > li > .info > .desc {
            font-size: 13pt;
            font-weight: 300;
            margin: 0px;
        }
        .event-list > li > .info > ul,
        .event-list > li > .buttonwrap > ul {
            display: table;
            list-style: none;
            margin: 10px 0px 0px;
            padding: 0px;
            width: 100%;
            text-align: center;
        }
        .bookpackage{
            font-size: 12pt;
            font-weight: 700;
            padding: 8px 12px;
            border: 0;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }
        #price-num {
            display: inline;
            font-weight: 800;
            font-size: 14pt;
        }
        #price-string {
            display: inline;
        }

        @media (min-width: 1024px) {
            .event-list > li {
                position: relative;
                display: block;
                width: 100%;
                height: 120px;
                padding: 0px;
            }
            .event-list > li > time,
            .event-list > li > img  {
                display: inline-block;
            }
            .event-list > li > time,
            .event-list > li > img {
                width: 120px;
                float: left;
            }
            .event-list > li > .info > .club-emblem .title {
                font-size: 16pt;
                margin: 0px;
                padding-top: 15%;
            }
            .event-list > li > .info {

                overflow: hidden;
            }
            .event-list > li > time,
            .event-list > li > img {
                width: 120px;
                height: 120px;
                padding: 0px;
                margin: 0px;
            }
            .event-list > li > .info {
                position: relative;
                height: 120px;
                text-align: center;
                padding-right: 125px;
                padding-top: 0;
            }
            .event-list > li > .info > .title,
            .event-list > li > .info > .desc {
                padding: 0px 10px;
            }
            .event-list > li > .info > ul {
                position: absolute;
                left: 0px;
                bottom: 0px;
            }
            .event-list > li > .buttonwrap {
                position: absolute;
                top: 0px;
                right: 0px;
                display: block;
                width: 125px;
                padding: 15px 0;
                height: 120px;
                border-left: 1px solid rgb(230, 230, 230);
                text-align: center;
            }
            .event-list > li > .buttonwrap > ul {
                padding-left: 0;
            }
            .event-list > li > .buttonwrap > ul > li {
                display: block;
            }
        }

        @media (max-width: 769px) {
            .bookpackage {
                padding:10px 150px;
            }
        }

        @media (max-width: 420px) {
            .bookpackage {
                padding:10px 120px;
            }
            #clubs-images {
                font-size: 24pt;
                width: 100%;
                padding-top: 6%
            }
            #homeemblem {
                margin-left: 10px;
                float:left;
                margin-right: 48px;
                width: 100px;
                height:100px;
            }
            #clubs-images > p {
                float: left;
                padding-top: 30px;
            }
            #awayemblem {
                margin-right: 10px;
                margin-left: 48px;
                float: right;
                width: 100px;
                height: 100px;
            }
            .event-list > li > .info > .club-emblem .title {
                font-size: 17pt;
                padding-top: 6%
            }
        }

        @media (max-width: 320px) {
            .bookpackage {
                padding:10px 100px;
            }
            #homeemblem {
                margin-right: 29px;
            }
            #awayemblem {
                margin-left: 29px;
            }
            .event-list > li > .info > .club-emblem .title {
                font-size: 15pt;
            }
        }
    </style>

    @stop

@section('content')

<!-- Header -->

<!-- About -->
<div class="container">
    <div id="cart_content"></div>
</div>

<section id="about" class="about">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <span class="main-title-name"><h4>{{Translater::getValue('main-title-name')}}</h4></span>
            </div>
            <div class="col-lg-12 text-center">
                <form name="searchmatch" id="searchmatch" novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="club_id" name="club" value="{{$clubId}}">
                    <input type="hidden" id="city_id" name="city" value="{{$cityId}}">
                    <input type="hidden" id="tournament_id" name="tournament" value="{{$tournamentId}}">
                    <span class="form-group col-lg-3 col-md-6">
                        <div class="input-group date match_date" data-date="" data-date-format="dd MM yyyy" data-link-field="match_date" data-link-format="yyyy-mm-dd">
                        <input class="form-control input-lg" placeholder="{{Translater::getValue('form-label-search-by-date')}}" size="16" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>

                <input type="hidden" id="match_date" name="match_date" value="" />
                    </span>
                    <input type="hidden" name="sorttype" id="sorttype" />
                    <input type="hidden" name="sortorder" id="sortorder" />

                    <span class="form-group col-lg-3 col-md-6">
                        <div name="tournament" id="tournament" class="form-control input-lg col-xs-4">
                        </div>
                    </span>
                    <span class="form-group col-lg-3 col-md-6">
                        <div name="city" id="city" class="form-control input-lg col-xs-4">
                        </div>
                    </span>
                    <span class="form-group col-lg-3 col-md-6">
                        <div name="club" id="club" class="form-control input-lg col-xs-4">
                        </div>
                    </span>
                    <input type="hidden" name="ajaxload_match" id="ajaxload_match" value="{{ $ajaxload_match }}" />
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div style="height: 50px;"></div>

    <div id="allmatches" class="container" style="display: block;">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <form  name="sortform" id="sortform" class="form-inline" style="padding-bottom: 10px; text-align: right; display: none;">
                    <div class="form-group">
                        <label >{{Translater::getValue('label-sort-by')}}:</label>
                    </div>
                    <div class="form-group">
                        <div class="dropdown">
                            <button  class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Sort <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a class="sort" data-sort="price" data-sorttype="asc">{{Translater::getValue('label-price')}}: &euro; {{Translater::getValue('label-low-to-high')}} </a></li>
                                <li><a class="sort" data-sort="price" data-sorttype="desc">{{Translater::getValue('label-price')}}: &euro; {{Translater::getValue('label-high-to-low')}}</a></li>
                                <li><a class="sort" data-sort="date" data-sorttype="asc">{{Translater::getValue('label-data-ascending-for-sort')}}</a></li>
                                <li><a class="sort" data-sort="date" data-sorttype="desc">{{Translater::getValue('label-data-descending-for-sort')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </form>


                <ul class="event-list" id="allmatcheslist">
                   {{-- @foreach($matches as $value)
                        <li><time datetime="{{ date("Y-m-d", strtotime($value['match_date'])) }}"><span class="day"> {{ date("d", strtotime($value['match_date'])) }}</span><span class="month">{{ date("M", strtotime($value['match_date'])) }}</span><span class="year">{{ date("Y", strtotime($value['match_date'])) }}</span><span class="time">ALL DAY</span></time><img alt="Independence Day" src="{{ ((File::exists(base_path(). '/public/uploads/matches/'.$value['image_name']) and !empty($value['image_name'])) ? url("uploads/matches/".$value['image_name']) : url("assets/img/no-image-available.png")) }}" /><div class="info"><h2 class="title">{{ $value->getHomeClub->name }}(home) - {{ $value->getAwayClub->name }}(away)</h2><p class="desc"> {{ $value->getStadium->cities->name }}, {{ $value->getStadium->country->name }}</p></div><div class="buttonwrap"><ul><li><a href="addpackage/{{$value->id}}" data-match="{{$value->id}}"  class="btn btn-primary bookpackage">Book Now</a></li><li><span class="fa fa-money"></span> &euro;{{ $value->competitionSeatingGet->min('price') }}</li></ul></div></li>
                   @endforeach--}}
                </ul>
            </div>
        </div>
    </div>
    @section('footer_scripts')
    <script>
        var cityTextSelected = "<?php echo e(Translater::getValue('form-title-choose-a-city')); ?>";
        var clubTextSelected = "<?php echo e(Translater::getValue('form-label-choose-club')); ?>";
        var tournamentTextSelected = "<?php echo e(Translater::getValue('form-label-choose-tournament')); ?>";
    </script>
        <link href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
        <script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/only_tickets/js/homepage.js') }}"></script>
        <script src="{{ asset('assets/js/ddslick.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#city').ddslick({
                        data:[],
                        selectText: cityTextSelected,
                        onSelected: function(data){
                            $('#club').ddslick("destroy");
                            $("#club").empty();
                            $('#club_id').val("0")
                            filterMatches('yes', 'no');
                        }
            });
             $('#club').ddslick({
                        data:[],
                        selectText: clubTextSelected,
                        onSelected: function(data){
                            filterMatches('no', 'no');
                        }
            });
             $('#tournament').ddslick({
                        data:[],
                        selectText: tournamentTextSelected,
                        onSelected: function(data){
                            filterMatches('no', 'yes');
                        }
                });
        });
    </script>
    @stop
</section>
<!-- Callout -->


@stop