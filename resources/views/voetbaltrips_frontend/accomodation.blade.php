@extends('newtemplate/layout')

@section('header_styles')
    <link rel="stylesheet"  media="all" href="{{ asset('assets/css/star-rating.min.css')}}">

    <style>
        /*********************************************
        Call Bootstrap
        *********************************************/

        @import asset("assets/css/frontend/bootstrap.min.css");
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
        .product-price {
            font-size: 20px;
        }
    </style>
@stop

@section('content')

    <!-- About -->
    <section id="" class="">
        <div class="container">
            <div id="cart_content" class="cart_roomselection"></div>
        </div>
        <div class="content-wrapper">
            <div class="container">
                @if($accomodations->count() > 0)
                 <div class="row">
                    <div class="alert alert-info" role="alert">
                        <span>{{Translater::getValue('alert-accomodation')}}</span>     
                    </div>
                </div>
                <div class="row">
                    @foreach ($accomodations as $opt)
                        @if($cart_hotel['accomo_id'] == $opt->id)
                            <div class="col-md-8">
                                <div id="hotel_information">
                                    <div class="col-sm-12 col-md-offset-0">
                                        <div>
  <!-- Indicators -->
  <ul id="lightSlider" class="gallery list-unstyled cS-hidden">
  @foreach($opt->images as $key => $image)
    <li data-thumb='{{url("uploads/hotel/".$image->image)}}' data-src='{{url("uploads/hotel/".$image->image)}}'>
        <img style="width:100%" src="{{ ((File::exists(base_path()."/public/uploads/hotel/".$image->image) == true) ? url("uploads/hotel/".$image->image): url("assets/img/no-image-available.png")) }}" alt="...">
    </li>
  @endforeach
  </ul>
</div>
                                    </div>
                                    <div class="col-sm-12 col-md-offset-0">
                                        <div class="col-sm-6 col-md-offset-0">
                                            <div class="facilities">
                                                <h4>{{Translater::getValue('form-label-address')}}</h4>
                                                <p>{{ $opt->address}},&nbsp; {{ $opt->cityobj->name }},&nbsp;
                                                {{ $opt->country->name }}</p>
                                                <input id="rating-system" type="number" class="rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $opt->stars }}" name="stars"/>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-offset-0">
                                            <div class="facilities">
                                                <h4>{{Translater::getValue('form-label-facilities')}}</h4>
                                                <ul>
                                                    @foreach ($opt->getOptions as $o)
                                                        @foreach($o->getTranslate as $trans)
                                                            @if ($trans->lang_code == Session::get('lang_code'))
                                                                <li>{{$trans->trans_name}} </li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="col-md-4">
                        <div class="form-wraper">
                        <form name="frmroomdetails" id="frmroomdetails" method="post" action="{{ url('roomsave/'.$match_id) }}">
                            <input type="hidden" id="match_id" name="match_id" value="{{$match_id}}">
                            {{ csrf_field() }}
                            <div class="product-title">{{Translater::getValue('form-label-choose-your-accommodation')}}</div>
                            <hr>
                            <div class="product-price">
                                <?php $breakfast = 0 ?>
                                @foreach($accomodations as $key=>$accomo)
                                    <?php
                                    if ($cart_hotel['accomo_id'] == $accomo->id)  $breakfast = $accomo->breakfast_price;
                                    ?>
                                <div class="form-group">
                                    <span><label for="accomo"> <input type="radio" name="accomo" value="{{ $accomo->id }}" {{(($cart_hotel['accomo_id'] == $accomo->id)?'checked="checked"':'')}}> {{ $accomo->name}} + {{ number_format(addAdditionalPrice($accomo->low_season_prices)- addAdditionalPrice($accomodations->min("low_season_prices")), 2) }} {{strtolower(Translater::getValue('per-person-per-night'))}}</label></span>
                                </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                            @if($breakfast != "0.00" )
                                <div class="include-breakfast-block">
                                    <h4>{{Translater::getValue('form-quest-include-breakfast')}}?</h4>
                                        <p>
                                        &euro; <span id="breakfast_price">{{ addAdditionalPrice($breakfast) }}</span> {{strtolower(Translater::getValue('per-person-per-night'))}}
                                        </p>
                                    <input id="input-1" name="include_breakfast" type="checkbox" data-off-title="No" data-on-title="{{Translater::getValue('label-yes')}}" data-off-icon-cls="glyphicon-thumbs-down" data-on-icon-cls="glyphicon-thumbs-up" {{ (($cart_hotel['include_breakfast'] == "on")?'checked="checked"':"") }}>
                                </div>
                            @endif
                            </div>
                            <div class="form-group" style="display: none">
                                <label for="room_days">{{Translater::getValue('form-label-numbe-of-days-room-needed')}}&nbsp;</label>
                                <select name="room_days" id="room_days" >
                                    @for($x=$days_needed; $x<=30; $x++)
                                    <option value="{{$x}}" {{ (($x== $days_needed)?'selected="selected"':"") }}>{{$x}}</option>
                                    @endfor
                                </select>
                            </div>
                            <hr>
                            <div class="btn-group cart next-prev">
                                <a style="margin-right:10px;" href="{{url("match/".$match_id."/flight")}}" class="btn btn-info btn-nm">
                                    <span class="glyphicon glyphicon-backward"></span> {{Translater::getValue('button-back-to-flights-page')}}
                                </a>
                                <button type="button" class="btn btn-success" name="addroomtocart" id="addroomtocart">{{Translater::getValue('button-next')}}</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($accomodations as $opt)
                            @if($cart_hotel['accomo_id'] == $opt->id)
                                <h3>{{Translater::getValue('title-hotel-description')}}</h3>
                                <div class="product-description">
                                    @foreach ($opt->getTranslate as $trans)
                                        @if ($trans->lang_code == Session::get('lang_code'))
                                            {{$trans->description}}
                                        @endif

                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @else
                    <div class="row">
                        <p class="alert alert-error">{{Translater::getValue('form-message-there-is-no-accommodations-available')}}</p>
                    </div>
                @endif
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
            <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/lightslider.css') }}" />  
            <script src="{{ asset('assets/js/star-rating.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/js/bootstrap-checkbox.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/voetbaltrips_frontend/js/accomodation.js') }}"></script>

            <script src="{{ asset('assets/js/lightslider.js') }}"></script>
            <script type="text/javascript">
                
                $(document).ready(function() {
                    $("#lightSlider").lightSlider({
                        gallery:true,
                        item:1,
                        thumbItem:4,
                        speed:500,
                        adaptiveHeight:true,
                        auto:false,
                        loop:true,
                        onSliderLoad: function() {
                            $('#lightSlider').removeClass('cS-hidden');
                        }    
                    });  
                });
            </script>
        @stop
    </section>

@stop
