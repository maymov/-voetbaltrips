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
        <div class="content-wrapper">
            @if (!empty($fixed))
                @if (!session()->get('show'))
                    <input class="hide" name="{{$fixed['title']}}" text="{{$fixed['text']}}" value="{{$fixed['val']}}" id="fixed">
                    {{session()->set('show', true)}}
                @endif
            @endif
            <div class="item-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <img id="item-display" src="{{ ((File::exists(base_path()."/public/uploads/stadiums/".$match->getStadium->image) == true) ? url("uploads/stadiums/".$match->getStadium->image): url("assets/img/no-image-available.png")) }}" alt="">
                        </div>

                        <div class="col-md-7">
                            <form name="frmmatchdetails" id="frmmatchdetails" method="post" action="{{ url('matchsave/'.$match_id) }}">
                                <input type="hidden" id="match_id" value="{{$match_id}}" name="match_id">
                                {{ csrf_field() }}
                                <h3>{{(Translater::getValue('label-choose-youre-seats'))}}</h3>
                                <div class="product-desc"></div>
                                @if(count($match->competitionSeatingGet) > 0)
                                    {{--<p><span id="tqty"></span> x&nbsp; &euro;<span id="tprice"> </span> = &euro;<span id="totprice"></span> </p>--}}
                                <div class="product-price form-group categories">
                                    @foreach($match->competitionSeatingGet()->orderby("price", "desc")->get() as $x=>$seat)
                                        @if($seat->price != 0)
                                            <div style="padding:20px 10px 12px 15px; margin-right: 15px; border-radius: 8px; background-color: {{ "#".$seat->seatingCategory->color}}" class="form-group">
                                                <input class="rdticket" type="radio" name="ticket" data-price="{{ addAdditionalPrice($seat->price) }}" value="{{ $seat->id }}" {{ (($cart_match['identifier'] == $seat->id)?'checked="checked"':"") }}>&nbsp;<label for="ticket">{{ucfirst(Translater::getValue('label-category-small'))}} {{substr($seat->seatingCategory->name, -1)}}     &euro; + {{ number_format((addAdditionalPrice($seat->price) - addAdditionalPrice($min) - addAdditionalPrice($seat->discount)), 2)  }} </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="product-price form-group quantity">
                                    <div class="col-sm-4">
                                    <div class="product-stock product_status">{{Translater::getValue('label-in-stock')}}</div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="ticket_quantity">{{Translater::getValue('label-quantity')}}</label>
                                </div>
                                <div class="col-sm-2">
                                     {!!   Form::select('ticket_quantity', [1=>1, 2=>2,3=>3,4=>4,5=>5], $cart_qty, ["class"=>"form-control", "id"=>"ticket_quantity"]) !!}
                                </div>
                                <div class="col-sm-3">
                                        <button type="button" class="btn btn-success" name="addtocart" id="addtocart">{{Translater::getValue('button-next')}}</button>
                                    @else
                                        <p class="alert alert-danger" align="center">{{Translater::getValue('message-no-tickets-available')}}</p>
                                    @endif
                                </div>
                            </div>
                        </form>
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
    <script src="{{ asset('assets/only_tickets/js/match.js') }}"></script>
    @stop
</section>
@stop