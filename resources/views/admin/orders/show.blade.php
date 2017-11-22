@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
order
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Order Details</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>orders</li>
        <li class="active">orders</li>
    </ol>
</section>
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    {{ ucwords($order->first_name) }}'s Order details
                </h4>
            </div>
            <br />
            <ul id="myTab" class="nav nav-tabs nav_tabs">
                <li class="active"><a href="#service-one" data-toggle="tab">Tickets</a></li>
                <li>
                    <a href="#service-two" data-toggle="tab">
                        Match Details
                        @if(isset($order->getMatchesOrder->processed_text) && isset($order->getMatchesOrder->actual_price) && $order->getMatchesOrder->actual_price != 0)
                            <span class="glyphicon glyphicon-ok" style="color:green;"></span>
                        @endif
                    </a>
                </li>
                @if(isset($order->getOrderFlightDetails) and count($order->getOrderFlightDetails) > 0)
                <li>
                    <a href="#service-three" data-toggle="tab">
                        Flight Details
                        @if(isset($order->getOrderFlightDetails[0]->reservation_number) && isset($order->getOrderFlightDetails[0]->actual_price) && $order->getOrderFlightDetails[0]->actual_price != 0)
                            <span class="glyphicon glyphicon-ok" style="color:green;"></span>
                        @endif
                    </a>
                </li>
                @endif
                @if(isset($order->getHotelDetails) and !empty($order->getHotelDetails))
                <li>
                    <a href="#service-four" data-toggle="tab">
                        Hotel Details
                        @if(isset($order->getHotelDetails->hotel_name) && isset($order->getHotelDetails->actual_price) && $order->getHotelDetails->actual_price != 0)
                            <span class="glyphicon glyphicon-ok" style="color:green;"></span>
                        @endif
                    </a>
                </li>
                @endif
                @if($order->getOrderOptions->count() > 0)
                    <li><a href="#service-five" data-toggle="tab">Extra Options</a></li>
                @endif
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="service-one">
                    <div class="row">
                        <div class="panel-primary">
                            <table class="table">
                                <tr>
                                    <td>Payment Method</td>
                                    <td>{!! $order->payment_method !!}</td>
                                </tr>
                                <tr>
                                    <td>Payment Status</td>
                                    {{--<td>{!! ((isset($order->getPaymentStatus->name))? $order->getPaymentStatus->name:"") !!}</td>--}}
                                    <td>{!! $order->mollie_payment_status !!}</td>
                                </tr>
                                <tr>
                                    <td>Order Status</td>
                                    <td>{!! ((isset($order->getOrderStatus->name))?$order->getOrderStatus->name:"") !!}</td>
                                </tr>
                                <tr>
                                    <td>Order Total</td>
                                    <td>&euro;&nbsp;{!! $order->order_total !!}</td>
                                </tr>
                            </table>

                            @if($order->order_status !=3)
                                <p class="alert alert-info">Upload the tickets for match, flight and room</p>
                            <form name="frmticketupload" id="frmticketupload" method="post" action="{!! url("admin/orders/".$order_id."/ticketupload") !!}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <table class="table">
                                    <tr><td>Ticket Type</td>
                                        <td>
                                            {!! Form::select("ticket_type", $ticket_type, null, ['placeholder' => 'Pick a Ticket Type...', "class" => "form-control", "required" => "required" ]) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ticket</td>
                                        <td><input type="file" required class="form-control" name="ticket"> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><button type="submit" class="btn btn-success btn-lg">Upload Ticket</button> </td>
                                    </tr>
                                </table>
                            </form>
                                @endif
                        </div>
                        <div class="panel panel-primary ">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Already Uploaded Tickets
                                </h4>
                            </div>
                            <br />

                            <div class="panel-body">
                                <table class="table table-bordered " id="table">
                                    <thead>
                                    <tr class="filters">
                                        <th>#</th>
                                        <th>Type of Ticket</th>
                                        <th>Uploaded On</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($order->getAdminUploadedTickets->count() > 0)
                                        @foreach($order->getAdminUploadedTickets as $x=>$ticket)
                                            <tr>
                                                <td>{{ ($x+1) }}</td>
                                                <td>{{ $ticket->getTicketType->name }}</td>
                                                <td>{{ $ticket->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center">No Tickets Uploaded</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($order->order_status !=3)
                    <div class="row">
                        <section class="">
                        <p class="alert alert-info"><i class="fa fa-info-circle"></i>&nbsp; When all the tickets are uploaded then please set the order status as Completed.</p>
                        <form name="frmorder" method="post" action="{{url('admin/orders/'.$order->id.'/complete')}}">
                            {{ csrf_field() }}
                            <button class="btn btn-success btn-lg text-center" type="submit">Set Order as Complete</button>
                        </form>
                        </section>
                    </div>
                        @endif
                </div>
                <div class="tab-pane tab-pane fade" id="service-two">
                    <section class="">
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

                        <table class="table">
                            <form method="post" action="{!! url("admin/orders/".$order_id."/updateMatch") !!}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <tr>
                                        <td>Tickets Processed</td>
                                        <td>{!! Form::text('processed_text', $order->getMatchesOrder->processed_text, ['class' => 'form-control']) !!} </td>
                                    </tr>
                                    <tr>
                                        <td>Actual Price</td>
                                        <td>{!! Form::number('actual_price', $order->getMatchesOrder->actual_price, ['class' => 'form-control']) !!}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><button type="submit" class="btn btn-success btn-lg">Save</button> </td>
                                    </tr>
                            </form>
                        </table>
                    </section>
                </div>

                @if(isset($order->getOrderFlightDetails) && count($order->getOrderFlightDetails) > 0)
                <div class="tab-pane fade" id="service-three">
                    <section class="">
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
                                            <td>{!! $flight->departure_date !!}</td>
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

                        @foreach($order->getTravellerInformation  as $flight)
                            <div class="panel panel-primary ">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        Traveller Information
                                    </h4>
                                </div>
                                <br />
                                <div class="panel-body">
                                    <table class="table">
                                        <tr><td>Name</td><td>{{ $flight->name }}</td></tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{{ $flight->country_text }}</td>

                                        </tr>
                                        <tr><td>City</td><td>{{ $flight->city_text }} </td></tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $flight->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Postcode</td>
                                            <td>{!! $flight->postcode !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone number</td>
                                            <td>{!! $flight->phone_number !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{!! $flight->email !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Date of birth</td>
                                            <td>{!! $flight->date_of_birth !!}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach


                        <table class="table">
                            <form method="post" action="{!! url("admin/orders/".$order_id."/updateFlight") !!}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <tr>
                                        <td>Reservation number</td>
                                        <td>{!! Form::text('reservation_number', $order->getOrderFlightDetails[0]->reservation_number, ['class' => 'form-control']) !!} </td>
                                    </tr>
                                    <tr>
                                        <td>Actual flights price</td>
                                        <td>{!! Form::number('actual_price', $order->getOrderFlightDetails[0]->actual_price, ['class' => 'form-control']) !!}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><button type="submit" class="btn btn-success btn-lg">Save</button> </td>
                                    </tr>
                            </form>
                        </table>
                    </section>
                </div>
                @endif
                @if(isset($order->getHotelDetails) and !empty($order->getHotelDetails))
                <div class="tab-pane fade" id="service-four">
                    <section class="">
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
                                    <td>Number of days customer want to stay in the room : </td>
                                    <td>{{ $order->getHotelDetails->rooms_days }}</td>
                                </tr>
                            </table>
                        </div>

                        <table class="table">
                            <form method="post" action="{!! url("admin/orders/".$order_id."/updateRoom") !!}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <tr>
                                        <td>Hotel name</td>
                                        <td>{!! Form::text('hotel_name', $order->getHotelDetails->hotel_name, ['class' => 'form-control']) !!} </td>
                                    </tr>
                                    <tr>
                                        <td>Actual hotel price</td>
                                        <td>{!! Form::number('actual_price', $order->getHotelDetails->actual_price, ['class' => 'form-control']) !!}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><button type="submit" class="btn btn-success btn-lg">Save</button> </td>
                                    </tr>
                            </form>
                        </table>
                    </section>
                </div>
                @endif
                @if(isset($order->getOrderOptions) and !empty($order->getOrderOptions))
                <div class="tab-pane tab-pane fade" id="service-five">
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
                @endif
            </div>
        </div>
    </div>
</section>
</div>
@stop