<div id="load_popup_modal_contant" class="" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">My Cart</h4>
            </div>
            <div class="modal-body">
                @if(empty($match_id))
                    <h3 class="text-center">There is no items added to the cart...</h3>
                @endif
                <div class="row">
                    <div class="content">
                        @if(!empty($match_id))
                            <div class="col-lg-12">
                                <span class="form-group col-xs-9">
                                    {{ $match_data['name'] }}
                                </span>
                                <span class="form-group col-xs-3 text-right">
                                {{--{{ $match_data['price'] }} x {{  $quantity }} =   &euro;{{ ($match_data['price']*$quantity) }}--}}
                                </span>
                            </div>
                        @endif
                        @if(isset($dept_flight))
                            <div class="col-lg-12">
                                <span class="form-group col-xs-9">
                                    Outgoing Flight - {{ ucwords($dept_flight->airline->name) }}
                                </span>
                                <span class="form-group col-xs-3 text-right">
                                {{--{{ addAdditionalPrice($dept_flight->price) }} x {{ $quantity }}  =  &euro;{{ (addAdditionalPrice($dept_flight->price)*$quantity) }}--}}
                                </span>
                            </div>
                        @endif
                        @if(isset($return_flight))
                            <div class="col-lg-12">
                                <span class="form-group col-xs-9">
                                    Return Flight - {{ ucwords($return_flight->airline->name) }}
                                </span>
                                <span class="form-group col-xs-3 text-right">
                                {{--{{ addAdditionalPrice($return_flight->price) }} x {{ $quantity }}  =  &euro;{{ (addAdditionalPrice($return_flight->price)*$quantity) }}--}}
                                </span>
                            </div>
                        @endif
                        @if(isset($room))
                            <div class="col-lg-12">
                                <span class="form-group col-xs-9">
                                Hotel - {{ ucwords($room['name']) }}
                                </span>
                                <span class="form-group col-xs-3 text-right">
                               {{-- {{ $room['price'] }} x {{ $quantity }}  =  &euro;{{ ($room['price'] * $quantity) }}--}}
                                </span>

                            </div>
                            @if($room['include_breakfast'] == "on")
                                    <div class="col-lg-12">
                                <span class="form-group col-xs-9">
                            Breakfast -
                            </span>
                                <span class="form-group col-xs-3 text-right">
                                {{--{{ $room['breakfast_price'] }} x {{ $quantity }} = &euro;{{ ($room['breakfast_price'] * $quantity) }}--}} Yes
                            </span>
                                    </div>
                                @endif
                            <div class="col-lg-12">
                                <span class="form-group col-xs-9">
                                Number of days rooms needed -
                                </span>
                                <span class="form-group col-xs-3 text-right">
                                    {{ $room['room_days'] }}
                                </span>
                            </div>
                        @endif
                            @if(isset($options))
                                <div class="col-lg-12">
                                    <h4>Options Selected</h4>
                                    @foreach($options as $x=>$opt)
                                        <span class="form-group col-xs-9">
                                            {{ ucwords($opt['name']) }}
                                        </span>
                                        <span class="form-group col-xs-3 text-right">
                                            {{ $opt['price'] }} x {{ $opt['qty'] }}  =  &euro;{{ ($opt['price'] * $opt['qty']) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        @if(!empty($match_id))
                        <div class="col-lg-12 text-right">
                            <span class="col-xs-12"> <label>Total : &euro;{{ $total }}</label></span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ url("cart/summary") }}" class="btn btn-primary">View Full Cart</a>
                <button type="button" name="resetcart" id="resetcart" class="btn btn-info btn-small">Empty Cart</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

