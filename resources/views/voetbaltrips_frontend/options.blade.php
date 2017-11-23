@extends('newtemplate/layout')
@section('content')
<style>
    .item-container{
        margin-top: 0;
    }
</style>
    <!-- About -->
    <section id="" class="">
        <div class="container">
            <div id="cart_content"></div>
        </div>
        <div class="content-wrapper extra-options">
            <div class="item-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        <h3 style="font-weight: 700;">{{Translater::getValue('title-label-extra-options-to-buy')}}</h3>
                            {{ csrf_field() }}
                        @foreach($options as $opt)
                                <?php
                                    $cart_val = '';
                                    if(isset($cart_options)) {
                                        $check_cart = array_search($opt->id, array_column($cart_options, 'opt_id'));
                                        if($check_cart !== false)
                                        $cart_val   = $cart_options[$check_cart]['cost'];
                                    }
                                ?>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <input type="radio" class="addoption" data-know="{{$opt->id}}" id="txt_{{$opt->id}}" value="{{$opt->price * $quantity}}" {{$cart_val > 0 ? 'checked' : ''}}>
                                    <span class="option-title" data-toggle="popover" title="{{$opt->title}}" animation="true" data-placement="top" data-trigger="hover" data-toggle="popover" data-html=true data-content="{{$opt->description}}">
                                        {{ $opt->title }}
                                    </span>
                                    <span>{{$opt->description}}</span>
                                    <div class="pull-right text-right">
                                        <span class="option-price">
                                            &euro; {{ addAdditionalPrice($opt->price) }}/ {{Translater::getValue('form-label-per-person')."."}}
                                        </span>
                                        <span class="option-price">
                                            Total: &euro; {{ addAdditionalPrice($opt->price) * $quantity }}
                                        </span>
                                        {{--<button class="btn btn-primary addoption" data-know="{{$opt->id}}">--}}
                                            {{--{{Translater::getValue('button-add')}}--}}
                                        {{--</button>--}}
                                        {{--<button class="btn btn-primary removeoption" data-know="{{$opt->id}}">--}}
                                            {{--<i class="fa fa-times" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-remove')}}--}}
                                        {{--</button>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            <div class="form-group text-right">
                                <a style="margin-right:10px;" href="{{url("match/".$match_id."/accomodation")}}" class="btn btn-info btn-nm">
                                    <span class="glyphicon glyphicon-backward"></span> {{Translater::getValue('button-back-to-accommodations-page')}}
                                </a>
                                <a href="{{url("travellerinfo/".$match_id)}}" class="btn btn-success btn-nm">{{Translater::getValue('button-next')}}</a>
                            </div>
                        </div>
                    </div>
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
                            {{--  Een geweldige wedstrijd --}}
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
            <script src="{{ asset('assets/voetbaltrips_frontend/js/options.js') }}"></script>
        @stop
    </section>
@stop