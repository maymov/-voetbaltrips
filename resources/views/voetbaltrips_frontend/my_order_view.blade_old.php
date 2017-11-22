@extends('newtemplate/layout')

{{-- Page title --}}
@section('title')
    User Account
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/skins/minimal/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@stop
{{-- Page content --}}
@section('content')
    <div class="container">
        <div class="welcome">
            <h2 class="text-primary text-center">My Order Summary</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--main content-->
                <div class="position-center">
                    <!-- Notifications -->
                    @include('notifications')
                </div>
            </div>
        </div>
        <div class="row">
            <ul id="myTab" class="nav nav-tabs nav_tabs">
                <li class="active"><a href="#service-one" data-toggle="tab">Traveller Information</a></li>
                <li><a href="#service-two" data-toggle="tab">Order Details</a></li>
                <li><a href="#service-three" data-toggle="tab">Match Details</a></li>
                <li><a href="#service-four" data-toggle="tab">Flight Details</a></li>
                <li><a href="#service-five" data-toggle="tab">Room Details</a></li>
                @if($order->getOrderOptions->count() > 0)
                    <li><a href="#service-six" data-toggle="tab">Extra Options Selected</a></li>
                @endif
            </ul>
        </div>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="service-one">
                <section class="product-info">
                    <div class="row">
                        <div class="">
                            {{----}}
                            @if($order->order_status == 2)
                                {!! csrf_field() !!}
                            <div class="panel-body">
                                <p class="alert alert-info text-center"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You have submitted all the required documents. The admin will send you tickets Shortly.</p>
                            </div>
                            @elseif($order->order_status == 3)
                                {!! csrf_field() !!}
                            <table id="table" class="table table-bordered ">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Type of Ticket</td>
                                    <td>Options</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->getAdminUploadedTickets as $x=>$ticket)
                                    <tr>
                                        <td>{{ ($x+1) }}</td>
                                        <td>{{ $ticket->getTicketType->name }}</td>
                                        <td>@if(File::exists(base_path("public/uploads/tickets/".$ticket->file_name))) <a href="{{ url('download/tickets/'.$ticket->file_name) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download</a> @else No Ticket Available @endif </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="panel-body">
                                <p class="alert alert-info">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    &nbsp;
                                    When you finish uploading the documents then admin will start the processing.
                                </p>
                                <form name="formtravelinfo" id="formtravelinfo" method="post" action=""  enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="change_data">Select a traveller to add Personal Details: </label>
                                        <select class="form-control" name="change_data" id="change_data" required="required">
                                            <option value="">Select a Traveller</option>
                                            @foreach($travel_info as $info)

                                                <option value="{{$info->id}}">{{ $info->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Full name (as per passport): </label>
                                        {!! Form::text('traveller_name', null, ["class"=>"form-control", "id"=>"traveller_name", "required"=>"required"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="dtp_input2">Date of Birth</label>
                                        <div class="input-group date form_dob_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dob" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" id="dob_show" type="text" value="" readonly>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="dob" value="" name="dob"/><br/>
                                    </div>
                                    <div class="form-group">
                                        <label for="airlines_id">Gender:</label>
                                        {!! Form::select("gender", ["male"=>"Male", "female"=>"Female"], null, ["class"=>"form-control", "required"=>"required", "id"=>"gender"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Address: </label>
                                        {!! Form::text('traveller_address', null, ["required"=>"required", "class" => "form-control", "id" => "traveller_address"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Postcode: </label>
                                        {!! Form::text('postcode', null, ["required"=>"required", "class" => "form-control", "id" => "postcode"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="from">Nationality: </label>
                                        {!! Form::select("country", $country, null, ["class" => "form-control", "required" => "required", "placeholder" => "Please pick a Country", "id"=>"country"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="from">City: </label>
                                        {!! Form::select("city", [], null, ["class" => "form-control", "required" => "required", "placeholder" => "Please pick a City", 'id' => "city"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone Number: </label>
                                        {!! Form::text("phone", null, ["required"=>"required", "id"=>"phone", "class"=>"form-control"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email: </label>
                                        {!! Form::text("email", null, ["required"=>"required", "id"=>"email", "class"=>"form-control"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="to">Identity Type: </label>
                                        {!! Form::select("identity_type", ["passport"=>"Passport"], null, ["class"=>"form-control", "id"=>"identity_type", "required"=>"required"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="duration">Passport Number: </label>
                                        {!! Form::text("passport_number", null, ["class"=>"form-control", "id"=>"passport_number", "required"=>"required"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="duration">Passport Validity: </label>
                                        <div class="input-group date form_passport_date" data-date="" data-date-format="dd MM yyyy" data-link-field="passport_validity" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" value="" readonly>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="passport_validity" value="" name="passport_validity"/><br/>
                                        {{--<input class="form-control" name="passport_validity[]" type="text" id="passport_validity" required>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="duration">Please upload passport document(in any of the following format jpg,jpeg,png,gif) : </label>
                                        {!! Form::file("passport_document", ["required"=>"required", "class"=>"form-control", "id"=>"passport_document"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <p class="alert alert-info text-center"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Please check the entries carefully before save the data. Once you save the data it cannot be change.</p>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary btn-lg" type="submit" id="update">Save Traveller Information</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane tab-pane fade" id="service-two">
                <section class="product-info">
                    <div class="row">
                        <div class="panel panel-primary ">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Order Summary
                                </h4>
                            </div>
                            <br />
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td>Order Placed on:</td>
                                        <td>{!! $order->created_at !!}</td>
                                    </tr>
                                    <tr><td>Match</td><td>{!! $order->getMatchesOrder->home_club !!} - {!! $order->getMatchesOrder->away_club !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td>{!! $order->payment_method !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status</td>
                                        <td>{!! $order->mollie_payment_status !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Status</td>
                                        <td>{!! $order->getOrderStatus->name !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Order Total</td>
                                        <td>{!! $order->order_total !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane tab-pane fade" id="service-three">
                <section class="product-info">
                    <div class="panel-body">
                        <table class="table">
                            <tr><td>Country</td><td>{{ $order->getMatchesOrder->country }}</td></tr>
                            <tr>
                                <td>City</td>
                                <td>{!! $order->getMatchesOrder->city !!}</td>
                            </tr>
                            <tr>
                                <td>Tournament</td>
                                <td>{!! $order->getMatchesOrder->tournament !!}</td>

                            </tr>
                            <tr><td>Match</td><td>{!! $order->getMatchesOrder->home_club !!} - {!! $order->getMatchesOrder->away_club !!}</td></tr>

                            <tr>
                                <td>Stadium</td>
                                <td>{!! $order->getMatchesOrder->stadium !!}</td>
                            </tr>

                            <tr>
                                <td>Match Date</td>
                                <td>{!! $order->getMatchesOrder->match_date !!}</td>
                            </tr>
                            <tr>
                                <td>Seat Category</td>
                                <td>{!! $order->getMatchesOrder->seating_type !!}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{!! $order->getMatchesOrder->price !!}</td>
                            </tr>
                            <tr>
                                <td>Number of match ticket</td>
                                <td>{!! $order->getMatchesOrder->quantity !!}</td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
            <div class="tab-pane tab-pane fade" id="service-four">
                <section class="product-info">
                    @foreach($order->getOrderFlightDetails  as $flight)
                        <div class="panel panel-primary ">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    {{(($flight->flightmode == 1)? 'Outgoing':'Incoming')}} Flight Details
                                </h4>
                            </div>
                            <br />
                            <div class="panel-body">
                                <table class="table">
                                    <tr><td>Airline Name</td><td>{{ $flight->airlines_name }}</td></tr>
                                    <tr>
                                        <td>Departure Airport Name</td>
                                        <td>{{ $flight->departure_airport }}</td>

                                    </tr>
                                    <tr><td>Destination Airport</td><td>{{ $flight->arrival_airport }} </td></tr>
                                    <tr>
                                        <td>Via</td>
                                        <td>{{ $flight->via }}</td>
                                    </tr>
                                    <tr>
                                        <td>Departure Date</td>
                                        <td>{{ $flight->departure_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Departure Time</td>
                                        <td>{!! $flight->departure_time !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Arrive Date</td>
                                        <td>{!! $flight->arrive_date !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Arrive Time</td>
                                        <td>{!! $flight->arrive_time !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Travel Duration</td>
                                        <td>{!! $flight->duration !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>{!! $flight->price !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Flight Tickets Needed</td>
                                        <td>{!! $flight->quantity !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </section>
            </div>
            <div class="tab-pane tab-pane fade" id="service-five">
                <section class="product-info">
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>Hotel Name</td>
                                <td>{{ $order->getHotelDetails->hotel_name }}</td>
                            </tr>
                            <tr>
                                <td>Star:</td>
                                <td>{{ $order->getHotelDetails->star }}</td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>{{$order->getHotelDetails->address}}</td>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>{{$order->getHotelDetails->city}}</td>
                            </tr>
                            <tr>
                                <td>Country:</td>
                                <td>{{$order->getHotelDetails->country}}</td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td>{{$order->getHotelDetails->price}}</td>
                            </tr>
                            <tr>
                                <td>Rooms Needed:</td>
                                <td>{{$order->getHotelDetails->quantity}}</td>
                            </tr>
                            @if($order->getHotelDetails->include_breakfast == "yes")
                                <tr>
                                    <td>Breakfast : </td>
                                    <td> Yes</td>

                                </tr>
                                <tr>
                                    <td>Breakfast Price : </td>
                                    <td> {{$order->getHotelDetails->breakfast_price}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Number of days reserved to stay in the hotel : </td>
                                <td>{{ $order->getHotelDetails->rooms_days }}</td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
            <div class="tab-pane tab-pane fade" id="service-six">
                <section class="product-info">

                    <div class="panel-body">
                        @foreach($order->getOrderOptions as $opt)
                            <div class="panel panel-default">
                                <div class="panel-body"><h4 >{{ $opt->title }}</h4>
                                    <p class="text-justify">{{$opt->description}}</p>
                                    <div class="pull-right text-right">
                                        &euro; {{ $opt->price }} x &nbsp;&nbsp;{{ $opt->quantity }}&nbsp;(Quantity)
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop

    {{-- page level scripts --}}
    @section('footer_scripts')
        <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendors/select2/select2.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
            <script type="text/javascript" language="javascript" src="{{ asset('assets/voetbaltrips_frontend/js/ordersummary.js') }}"></script>
@stop