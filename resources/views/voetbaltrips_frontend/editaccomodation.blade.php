@extends('newtemplate/layout')

@section('header_styles')
    <link rel="stylesheet"  media="all" href="{{ asset('assets/css/star-rating.min.css')}}">


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
     <!-- About -->
    <section id="" class="">

        <div class="content-wrapper">
            <div class="container">
                @if($accomodations->count() > 0)
                    <div class="row">
                        <div class="col-md-8">
                            <div id="hotel_information">
                                <div class="col-md-6 col-md-offset-0">
                                    <img src="{{ ((File::exists(base_path()."/public/uploads/hotel/".$default_acc->images) == true) ? url("uploads/hotel/".$default_acc->images): url("assets/img/no-image-available.png")) }}">
                                    <div class="product-description">
                                        <p>{{ $default_acc->description }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-0">
                                    <h4>Address</h4>
                                    <p>{{ $default_acc->address}},&nbsp; {{ $default_acc->cityobj->name }},&nbsp;
                                        {{ $default_acc->country->name }}</p>
                                    <input id="rating-system" type="number" class="rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $default_acc->stars }}" name="stars"/>
                                    <?php
                                    if($default_acc->options) {
                                    echo "<h4>Facilities</h4>";
                                    $ac_opt = explode(",",$default_acc->options);
                                    foreach ($ac_opt as $opt_value) {
                                    ?>
                                    <p><?php echo "- &nbsp;". $opt_value; ?></p>
                                    <?php
                                    }
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <form name="frmroomdetails" id="frmroomdetails" method="post" action="{{ url('roomsave/'.$match_id) }}">
                                <input type="hidden" id="match_id" name="match_id" value="{{$match_id}}">
                                <input type="hidden" name="edit" value="yes" />
                                {{ csrf_field() }}
                                <div class="product-title">{{$match->getHomeClub->name}}</div>
                                <div class="product-desc"></div>
                                {{--<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>--}}
                                <hr>
                                <div class="product-price">

                                    @foreach($accomodations as $key=>$accomo)
                                        <div class="form-group">
                                            <span> <input type="radio" name="accomo" value="{{ $accomo->id }}" {{(($cart_room['accomo_id'] == $accomo->id)?'checked="checked"':'')}}> <label for="accomo">{{ $accomo->name}} - &euro; {{ addAdditionalPrice($accomo->low_season_prices) }}</label></span>
                                        </div>
                                    @endforeach
                                </div>
                                {{--<div class="product-stock">Op voorraad</div>--}}
                                <div class="form-group">
                                    <h4>Include Breakfast?</h4>
                                    <p> &euro; <span id="breakfast_price">{{ addAdditionalPrice($default_acc->breakfast_price) }}</span> per person</p>
                                    <input id="input-1" name="include_breakfast" type="checkbox" data-off-title="No" data-on-title="Yes" data-off-icon-cls="glyphicon-thumbs-down" data-on-icon-cls="glyphicon-thumbs-up" {{ (($cart_room['include_breakfast'] == "on")?'checked':"") }}>
                                </div>
                                <hr>
                                <div class="btn-group cart">
                                    <button type="button" class="btn btn-success" name="addroomtocart" id="addroomtocart">Volgende/Next</button>
                                </div>
                                {{--<div class="btn-group wishlist">--}}
                                {{--<button type="button" class="btn btn-danger">--}}
                                {{--Add to wishlist--}}
                                {{--</button>--}}
                                {{--</div>--}}
                            </form>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <p class="alert alert-error">There is no accommodations available.</p>
                    </div>
                @endif
            </div>
        </div>
        @section('footer_scripts')
            <script src="{{ asset('assets/js/star-rating.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/js/bootstrap-checkbox.min.js')}}" type="text/javascript"></script>
            <script src="{{ asset('assets/voetbaltrips_frontend/js/accomodation.js') }}"></script>
        @stop
    </section>
@stop