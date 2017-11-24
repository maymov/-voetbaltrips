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
    <div class="container">
        <div id="cart_content"></div>
    </div>
    <div class="content-wrapper checkout-page">
        <div class="container">
            {{ csrf_field() }}
            <div style="display: block;" class="row" id="allmatches">
                    @if (!empty($home_team))
                        <input id="hometeamforticket" class="hide" name="{{$home_team['title']}}" text="{{$home_team['text']}}" title="{{$home_team['title']}}">
                        <p id="infosent" style="text-align: right; display: block">{{Translater::getValue('info-label-tickets-of-this-match-wil-be-sent-to-your-home')}}</p>
                    @else
                        <input id="hometeamforticket" class="hide" name="" text="">
                    @endif
                    <h3 class="page-title">{{Translater::getValue('title-summary-page')}}</h3>
                    @if($onlylyTicket)
                        @if(!isset($cart_data['match_id']))
                            <h3 class="text-center">{{Translater::getValue('warning-message-no-items-added')}}</h3>
                        @else
                        <div class="col-md-8 col-md-offset-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <h4> {{Translater::getValue('title-match-details')}}</h4>
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="form-group col-sm-4 label-title">
                                        {{Translater::getValue('title-match-name')}} :
                                    </div>
                                    <div class="form-group col-sm-6">
                                        {{ $cart_data['match_data']['name'] }}
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="form-group col-sm-4 label-title">
                                        {{Translater::getValue('title-quantity-selected')}} :
                                    </div>
                                    <div class="form-group col-sm-6">
                                        {{ $cart_data['quantity'] }}
                                    </div>
                                </div>
                                @if(!empty($cart_data['match_id']))
                                    <div class="form-group col-sm-12 total-cost" style="margin: 10px"> <h4>Total : &euro;{{ $cart_data['total_amount'] }}</h4></div>
                                @endif
                            </div>

                            <div class="col-md-12" style="text-align: center; padding-bottom: 20px;">
                                <p  style="color: #01BC8C"> * {{Translater::getValue('info-message-on-summary-page')}} &nbsp;</p>

                                <div class="btn-toolbar edit-remove-package tickets" style=" margin-right:5px; display: inline-block;">
                                    <a href="{{url("tickets/".$cart_data['match_id']) }}" class="btn btn-info btn-nm" style="margin: 5px">
                                        <span class="glyphicon glyphicon-edit"></span> {{Translater::getValue('button-edit-tickets')}}
                                    </a>
                                    <button type="button" name="resetcart" id="resetcart" class="btn btn-info btn-nm" style="margin: 5px"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-remove-tickets')}}</button>
                                    <a id="proceedtopayment" class="btn btn-success btn-nm" style="margin: 5px"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-proceed-to-payment')}}</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                    @if(!isset($cart_data['match_id']))
                        <h3 class="text-center">{{Translater::getValue('warning-message-no-items-added')}}</h3>
                    @else
                        <div class="col-md-4">
                            @for($x=0; $x < $cart_data['quantity']; $x++)
                                @if(isset($travel_info['traveller_name'][$x]))
                                    <label> {{Translater::getValue('form-label-traveller')}} {{($x+1)}} {{Translater::getValue('form-label-name')}} : {!! $travel_info['traveller_name'][$x] !!}</label><br>
                                    <label>{{Translater::getValue('form-label-date-of-birth')}}   : {!! $travel_info['dob'][$x] !!} </label><br>
                                    <label>{{Translater::getValue('form-label-gender')}}          : {!! $travel_info['gender'][$x] !!}</label><br>
                                    @if(isset($travel_info['traveller_email'][$x]))
                                        <label>{{Translater::getValue('form-label-email')}}          : {{($travel_info['traveller_email'][$x])}}</label><br>
                                    @endif
                                    @if(isset($travel_info['traveller_phone'][$x]))
                                        <label>{{Translater::getValue('form-label-phone')}}          : {!!$travel_info['traveller_phone'][$x]!!}</label><br>
                                    @endif
                                    @if(isset($travel_info['traveller_phone'][$x]))
                                        <label>{{Translater::getValue('form-label-postcode')}}          : {!!$travel_info['traveller_postcode'][$x]!!}</label><br>
                                    @endif
                                    @if(isset($travel_info['traveller_country'][$x]))
                                        <label>{{Translater::getValue('form-label-address')}}          : {!! $travel_info['traveller_address'][$x] !!}</label><br>
                                    @endif
                                    @if(isset($travel_info['traveller_country'][$x]))
                                        <label>{{Translater::getValue('form-label-city')}}          : {!! $travel_info['traveller_city'][$x] !!} </label><br>
                                    @endif
                                    @if(isset($travel_info['traveller_country'][$x]))
                                        <label>{{Translater::getValue('form-label-country')}}          : {!! $travel_info['traveller_country'][$x] !!}</label><br>
                                    @endif

                                @endif
                            @endfor
                            <a href="{!! url("travellerinfo/".$cart_data['match_id']) !!}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span>&nbsp;{{Translater::getValue('button-edit-travellers-data')}}</a>
                        </div>
                        <div class="col-md-8">
                            <div class="container">
                                <div class="row">
                                    <h4> {{Translater::getValue('title-match-details')}}</h4>
                                    <div class="form-group col-sm-5 label-title">
                                        {{Translater::getValue('title-match-name')}} :
                                    </div>
                                    <div class="form-group col-sm-7">
                                        {{ $cart_data['match_data']['name'] }}
                                    </div>
                                    <div class="form-group col-sm-5 label-title">
                                        {{Translater::getValue('title-quantity-selected')}} :
                                    </div>
                                    <div class="form-group col-sm-7">
                                        {{ $cart_data['quantity'] }}
                                    </div>
                                </div>
                                @if(isset($cart_data['dept_flight']))
                                    <div class="row">
                                        <h4>{{Translater::getValue('title-departure-flight-details')}}</h4>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-airline')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ ucwords($cart_data['dept_flight']->airline->name) }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-departure-airport')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ ucwords($cart_data['dept_flight']->source_airport->title) }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-destination-airport')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ ucwords($cart_data['dept_flight']->destination_airport->title) }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-departure-on')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{--{{ $cart_data['dept_flight']->departure_date }} {{ $cart_data['dept_flight']->departure_time }}--}}
                                            {{ \Carbon\Carbon::parse($cart_data['dept_flight']->departure_date.' '.$cart_data['dept_flight']->departure_time)->format('d-m-Y H:i') }}
                                        </div>
                                    </div>
                                @endif

                                @if(isset($cart_data['return_flight']))
                                    <div class="row">
                                        <h4>{{Translater::getValue('title-return-flight-details')}}</h4>
                                        <div class="form-group col-sm-5 label-title">
                                            Airline :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ ucwords($cart_data['return_flight']->airline->name) }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-departure-airport')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ ucwords($cart_data['return_flight']->source_airport->title) }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-destination-airport')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ ucwords($cart_data['return_flight']->destination_airport->title) }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-departure-on')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{--{{ $cart_data['return_flight']->departure_date }} {{ $cart_data['return_flight']->departure_time }}--}}
                                            {{ \Carbon\Carbon::parse($cart_data['return_flight']->departure_date.' '.$cart_data['return_flight']->departure_time)->format('d-m-Y H:i') }}
                                        </div>
                                    </div>
                                @endif
                                @if(isset($cart_data['room']))
                                    <div class="row">
                                        <h4>{{Translater::getValue('title-hotel-room-details')}}</h4>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-hotel-name')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ ucwords($cart_data['room']['name']) }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-breakfast-selected')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ (($cart_data['room']['include_breakfast'] == "on")?'Yes':"No") }}
                                        </div>
                                        <div class="form-group col-sm-5 label-title">
                                            {{Translater::getValue('title-number-of-days-rooms-needed')}} :
                                        </div>
                                        <div class="form-group col-sm-7">
                                            {{ $cart_data['room']['room_days'] }}
                                        </div>
                                    </div>
                                @endif
                                @if(isset($cart_data['options']))
                                    <div class="row">
                                        <div class="extra-options">
                                            <h4>{{Translater::getValue('title-extra-options-selected')}}</h4>
                                            @foreach($cart_data['options'] as $opt)
                                                <div class="panel panel-default" id="options_{{$opt['opt_id']}}">
                                                    <div class="panel-body">
                                                        <input type="radio" class="addoption" data-know="{{$opt['opt_id']}}" id="txt_{{$opt['opt_id']}} value="{{$opt['cost']}}" checked>
                                                        <span class="option-title">{{ $opt['name'] }}</span>
                                                        <div class="pull-right text-right">
                                                            &euro; {{ $opt['price'] }}/{{Translater::getValue('form-label-per-person')}} &nbsp;
                                                                Total: &euro; {{$opt['price'] * $cart_data['quantity']}}
                                                            {{--<input type="number" name="quantity" class="number_only" id="txt_{{$opt['opt_id']}}" min="1" value="{{$opt['qty']}}">--}}
                                                            {{--<button class="btn btn-primary updateoption" data-know="{{$opt['opt_id']}}"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-update')}}</button>--}}
                                                            <button class="btn btn-primary removeoption" data-know="{{$opt['opt_id']}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-remove')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <a href="{{url("match/".$cart_data['match_id']."/extras/addmore")}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-add-more-options')}}</a>
                                        </div>
                                    </div>

                                @endif

                                {{-- Coupon section --}}
                                <div class="row">
                                    <div class="form-group col-sm-12 coupon">
                                        <label for="value" class="col-sm-2 control-label">Coupon</label>
                                        <div class="col-sm-10">
                                            <input id="coupon_code" type="text" placeholder="" class="form-control" value="" />
                                        </div>
                                    </div>
                                </div>

                                @if(!empty($cart_data['match_id']))
                                    <div class="form-group col-sm-12 total-cost"> <h4>Total : &euro;{{ $cart_data['total_amount'] }}</h4></div>
                                @endif
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="edit-remove-package">
                                    <a href="{{url("match/".$cart_data['match_id']) }}" class="btn btn-info btn-nm">
                                        <span class="glyphicon glyphicon-edit"></span> {{Translater::getValue('button-edit-package')}}
                                    </a>
                                    <p align="center" style="color: #01BC8C"> * {{Translater::getValue('info-message-change-match')}} &nbsp;<button type="button" name="resetcart" id="resetcart" class="btn btn-info btn-nm"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-remove-package')}}</button></p>
                                </div>
                            </div>
                            <div class="col-md-12" style="text-align: center; padding-bottom: 20px;">
                                <a id="proceedtopayment" class="btn btn-success btn-nm"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-proceed-to-payment')}}</a>
                            </div>

                            @endif
                    @endif

                </div>
            </div>

        </div>
    </div>
    @section('footer_scripts')
        <script src="{{ asset('assets/voetbaltrips_frontend/js/cartsummary.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>
@stop