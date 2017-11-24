@extends('newtemplate/layout')

@section('header_styles')

<style>
    /*********************************************
    Call Bootstrap
    *********************************************/

    @import asset("assets/css/frontend/bootstrap.min.css");
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

    /*********************************************
    Theme Elements
    *********************************************/
</style>
@stop

@section('content')

<!-- About -->
<section id="" class="">
    <div class="container">
        <div id="cart_content"></div>
    </div>
    <div class="content-wrapper">
        
        <div class="container">

            <div style="display: block;" class="row" id="allmatches">
                <div class="col-md-12">
                    <div class="product-title" style="text-align: center; text-decoration: underline">
                        
                    </div>
                </div>
                <div class="container">
                    {{ csrf_field() }}
                    <div style="display: block;" class="row" id="allmatches">
                        @if(!isset($cart_data['match_id']))
                            <h3 class="text-center">{{Translater::getValue('warning-message-no-items-added')}}</h3>
                        @else
                            <div class="col-md-4">
                                @for($x=0; $x < $cart_data['quantity']; $x++)
                                    @if(!empty($travel_info['traveller_name'][$x]))
                                    <label>{{Translater::getValue('form-label-traveller')}} {{Translater::getValue('form-label-name')}}  : {!! $travel_info['traveller_name'][$x] !!}</label><br>
                                    <label>{{Translater::getValue('form-label-date-of-birth')}}   : {!! $travel_info['dob'][$x] !!} </label><br>
                                    <label>{{Translater::getValue('form-label-gender')}}          : {!! $travel_info['gender'][$x] !!}</label><br>
                                    @endif
                                @endfor
                            </div>
                            <div class="col-md-8">
                                <h4> {{Translater::getValue('title-match-details')}}</h4>
                                <span class="form-group col-md-12">
                            {{ $cart_data['match_data']['name'] }}
                        </span>
                                @if(isset($cart_data['dept_flight']))

                                    <h4>{{Translater::getValue('title-departure-flight-details')}}</h4>
                                    <span class="form-group col-xs-4">
                            {{Translater::getValue('title-airline')}} :
                        </span>
                                    <span class="form-group col-xs-8">
                            {{ ucwords($cart_data['dept_flight']->airline->name) }}
                        </span>
                                    <span class="form-group col-xs-4">
                            {{Translater::getValue('title-departure-airport')}} :
                        </span>
                                    <span class="form-group col-xs-8">
                            {{ ucwords($cart_data['dept_flight']->source_airport->title) }}
                        </span>
                                    <span class="form-group col-xs-4">
                            {{Translater::getValue('title-destination-airport')}} :
                        </span>
                                    <span class="form-group col-xs-8">
                            {{ ucwords($cart_data['dept_flight']->destination_airport->title) }}
                        </span>
                                    <span class="form-group col-xs-4">
                            {{Translater::getValue('title-departure-on')}} :
                        </span>
                                    <span class="form-group col-xs-8">
                            {{ $cart_data['dept_flight']->departure_date }} {{ $cart_data['dept_flight']->departure_time }}
                        </span>
                                @endif

                                @if(isset($cart_data['return_flight']))
                                    <h4>{{Translater::getValue('title-return-flight-details')}}</h4>
                                    <span class="form-group col-xs-4">
                                        {{Translater::getValue('title-airline')}} :
                                    </span>
                                                <span class="form-group col-xs-8">
                                        {{ ucwords($cart_data['return_flight']->airline->name) }}
                                    </span>
                                                <span class="form-group col-xs-4">
                                        {{Translater::getValue('title-departure-airport')}} :
                                    </span>
                                                <span class="form-group col-xs-8">
                                        {{ ucwords($cart_data['return_flight']->source_airport->title) }}
                                    </span>
                                                <span class="form-group col-xs-4">
                                        {{Translater::getValue('title-destination-airport')}} :
                                    </span>
                                                <span class="form-group col-xs-8">
                                        {{ ucwords($cart_data['return_flight']->destination_airport->title) }}
                                    </span>
                                                <span class="form-group col-xs-4">
                                        {{Translater::getValue('title-departure-on')}} :
                                    </span>
                                                <span class="form-group col-xs-8">
                                        {{ $cart_data['return_flight']->departure_date }} {{ $cart_data['return_flight']->departure_time }}
                                    </span>
                                @endif
                                @if(isset($cart_data['room']))
                                    <h4>{{Translater::getValue('title-hotel-room-details')}}</h4>
                                    <span class="form-group col-xs-4">
                                        {{Translater::getValue('title-hotel-name')}} :
                                    </span>
                                    <span class="form-group col-xs-8">
                                        {{ ucwords($cart_data['room']['name']) }}
                                    </span>
                                    <span class="form-group col-xs-4">
                                    {{Translater::getValue('title-breakfast-selected')}} :
                                    </span>
                                            <span class="form-group col-xs-8">
                                        {{ (($cart_data['room']['include_breakfast'] == "on")?'Yes':"No") }}
                                    </span>
                                    <span class="form-group col-xs-4">
                                {{Translater::getValue('title-number-of-days-rooms-needed')}} :
                            </span>
                                    <span class="form-group col-xs-8">
                            {{ $cart_data['room']['room_days'] }}
                            </span>
                                @endif
                                @if(isset($cart_data['options']))
                                    <h4>{{Translater::getValue('title-extra-options-selected')}}</h4>
                                    @foreach($cart_data['options'] as $opt)
                                        <span class="form-group col-xs-8">
                                            {{ $opt['name'] }}
                                        </span>
                                    @endforeach
                                @endif
                                @if(!empty($cart_data['match_id']))
                                    <span class="form-group col-xs-12">&nbsp;</span>
                                    @if($cart_data['coupon_wrong'])
                                        <span class="form-group col-xs-12 text-left"><b>Coupon code is wrong</b></span>
                                    @endif
                                    @if($cart_data['coupon_code'] != null)
                                        <span class="form-group col-xs-12 text-right"> <h4>Total (with discount): &euro;{{ $cart_data['total_amount'] }}</h4></span>
                                    @else
                                        <span class="form-group col-xs-12 text-right"> <h4>Total : &euro;{{ $cart_data['total_amount'] }}</h4></span>
                                    @endif
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 text-center"  style="text-align: center; padding-bottom: 20px;">
                <a href="{!! url("cart/summary") !!}" class="btn btn-primary btn-lg">{{Translater::getValue('button-go-back')}}</a>&nbsp;
                <a href="{!! url("cart/confirmorder") !!}" class="btn btn-success btn-lg">{{Translater::getValue('button-proceed-to-payment')}}</a>
            </div>
        </div>

    </div>
</section>
@stop