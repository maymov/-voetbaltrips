@extends('newtemplate/layout')

{{-- Page title --}}
@section('title')
    {{Translater::getValue('title-user-account')}}
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
            <h2 class="text-primary text-center">{{Translater::getValue('title-my-order-summary')}}</h2>
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
                <li class="active"><a href="#service-one" data-toggle="tab">{{Translater::getValue('title-traveller-information')}}</a></li>
                <li><a href="#service-two" data-toggle="tab">{{Translater::getValue('title-order-details')}}</a></li>
                <li><a href="#service-three" data-toggle="tab">{{Translater::getValue('title-match-details')}}</a></li>

                @if(count($order->getOrderFlightDetails) > 0)
                    <li><a href="#service-four" data-toggle="tab">{{Translater::getValue('title-flight-details')}}</a></li>
                @endif
                @if($order->getHotelDetails)
                    <li><a href="#service-five" data-toggle="tab">{{Translater::getValue('title-room-details')}}</a></li>
                @endif
                @if($order->getOrderOptions->count() > 0)
                    <li><a href="#service-six" data-toggle="tab">{{Translater::getValue('title-extra-options-selected')}}</a></li>
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
                                <p class="alert alert-info text-center"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; {{Translater::getValue('info-message-submit-required-doc')}}</p>
                            </div>
                            @elseif($order->order_status == 3)
                                {!! csrf_field() !!}
                            <table id="table" class="table table-bordered ">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <td>{{Translater::getValue('form-title-type-of-ticket')}}</td>
                                    <td>{{Translater::getValue('title-options')}}</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->getAdminUploadedTickets as $x=>$ticket)
                                    <tr>
                                        <td>{{ ($x+1) }}</td>
                                        <td>{{ $ticket->getTicketType->name }}</td>
                                        <td>@if(File::exists(base_path("public/uploads/tickets/".$ticket->file_name))) <a href="{{ url('download/tickets/'.$ticket->file_name) }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;{{Translater::getValue('button-download')}}</a> @else {{Translater::getValue('info-message-no-ticket-available')}} @endif </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="panel-body">
                                <p class="alert alert-info">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    &nbsp;
                                    {{Translater::getValue('info-message-when-finish-uploading-doc-admin-start-proc.')}}
                                </p>

                                <form name="formtravelinfo" id="formtravelinfo" method="post" action=""  enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="change_data">{{Translater::getValue('form-select-traveller-to-add-personal-details')}}: </label>
                                        <select class="form-control" name="change_data" id="change_data" required="required">
                                            <option value="">{{Translater::getValue('title-select-a-traveller')}}</option>
                                            @foreach($travel_info as $info)

                                                <option value="{{$info->id}}">{{ $info->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="traveller_first_name">{{Translater::getValue('form-label-first-name-as-per-passport')}}: </label>
                                        {!! Form::text('traveller_first_name', null, ["class"=>"form-control", "id"=>"traveller_first_name", "required"=>"required"]) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="traveller_last_name">{{Translater::getValue('form-label-last-name-as-per-passport')}}: </label>
                                        {!! Form::text('traveller_last_name', null, ["class"=>"form-control", "id"=>"traveller_last_name", "required"=>"required"]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="gender">{{Translater::getValue('form-label-gender')}}:</label>
                                        {!! Form::select("gender", ["male"=>"Male", "female"=>"Female"], null, ["class"=>"form-control", "required"=>"required", "id"=>"gender"]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="birth">{{Translater::getValue('form-label-date-of-birth')}}</label>
                                        <div class="input-group date form_passport_date" data-date="" data-date-format="dd MM yyyy" data-link-field="birth" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" value="" id="aaa" readonly>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="birth" value="" name="birth"/><br/>
                                        {{--<input class="form-control" name="passport_validity[]" type="text" id="passport_validity" required>--}}
                                    </div>

                                    {{--<div class="form-group">--}}
                                        {{--<label for="identity_type">{{Translater::getValue('form-label-pasport-type')}}: </label>--}}
                                        {{--{!! Form::select("identity_type", ["" => "Choose document type", "passport"=>"Passport", "identiteitskaart" => "Identiteitskaart"], null, ["class"=>"form-control", "id"=>"identity_type", "required"=>"required"]) !!}--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="nationality">{{Translater::getValue('form-label-nationality')}}: </label>--}}
                                        {{--{!! Form::text("nationality", null, ["class"=>"form-control", "id"=>"nationality", "required"=>"required"]) !!}--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="duration">{{Translater::getValue('form-label-passport-number')}}: </label>--}}
                                        {{--{!! Form::text("passport_number", null, ["class"=>"form-control", "id"=>"passport_number", "required"=>"required"]) !!}--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="duration">{{Translater::getValue('form-label-passport-validity')}}: </label>--}}
                                        {{--<div class="input-group date form_passport_date" data-date="" data-date-format="dd MM yyyy" data-link-field="passport_validity" data-link-format="yyyy-mm-dd">--}}
                                            {{--<input class="form-control" size="16" type="text" value="" readonly>--}}
                                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>--}}
                                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                                        {{--</div>--}}
                                        {{--<input type="hidden" id="passport_validity" value="" name="passport_validity"/><br/>--}}
                                        {{--<input class="form-control" name="passport_validity[]" type="text" id="passport_validity" required>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="duration">{{Translater::getValue('info-message-upload-passport-document')}} : </label>--}}
                                        {{--{!! Form::file("passport_document", ["required"=>"required", "class"=>"form-control", "id"=>"passport_document"]) !!}--}}
                                    {{--</div>--}}

                                    <div class="form-group">
                                        <p class="alert alert-info text-center"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> {{Translater::getValue('info-message-please-check-entries-carefully-before-save')}}</p>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary btn-lg" type="submit" id="update">{{Translater::getValue('button-save-traveller-information')}}</button>
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
                                    {{Translater::getValue('title-order-summary')}}
                                </h4>
                            </div>
                            <br />
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <td>{{Translater::getValue('title-order-placed-on')}}:</td>
                                        <td>{!! date("d-m-Y H:i:s", strtotime($order->created_at)) !!}</td>
                                    </tr>
                                    <tr><td>{{Translater::getValue('label-match')}}</td><td>{!! $order->getMatchesOrder->home_club !!} - {!! $order->getMatchesOrder->away_club !!}</td>
                                    </tr>
                                    <tr>
                                        <td>{{Translater::getValue('label-payment-method')}}</td>
                                        <td>{!! $order->payment_method !!}</td>
                                    </tr>
                                    <tr>
                                        <td>{{Translater::getValue('label-payment-status')}}</td>
                                        <td>{!! $order->mollie_payment_status !!}</td>
                                    </tr>
                                    <tr>
                                        <td>{{Translater::getValue('label-order-status')}}</td>
                                        <td>{!! $order->getOrderStatus->name !!}</td>
                                    </tr>
                                    <tr>
                                        <td>{{Translater::getValue('label-order-total')}}</td>
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
                            <tr><td>{{Translater::getValue('form-label-country')}}</td><td>{{ $order->getMatchesOrder->country }}</td></tr>
                            <tr>
                                <td>{{Translater::getValue('form-label-city')}}</td>
                                <td>{!! $order->getMatchesOrder->city !!}</td>
                            </tr>
                            <tr>
                                <td>{{ucfirst(Translater::getValue('label-tournament-small'))}}</td>
                                <td>{!! $order->getMatchesOrder->tournament !!}</td>

                            </tr>
                            <tr><td>{{Translater::getValue('label-match')}}</td><td>{!! $order->getMatchesOrder->home_club !!} - {!! $order->getMatchesOrder->away_club !!}</td></tr>

                            <tr>
                                <td>{{Translater::getValue('label-stadion')}}</td>
                                <td>{!! $order->getMatchesOrder->stadium !!}</td>
                            </tr>

                            <tr>
                                <td>{{Translater::getValue('form-label-match-date')}}</td>
                                <td>{{ date("d-m-Y H:i:s", strtotime($order->getMatchesOrder->match_date)) }}</td>
                            </tr>
                            <tr>
                                <td>{{Translater::getValue('form-label-seat-category')}}</td>
                                <td>{!! $order->getMatchesOrder->seating_type !!}</td>
                            </tr>

                            <tr>
                                <td>{{Translater::getValue('form-label-number-of-match-ticket')}}</td>
                                <td>{!! $order->getMatchesOrder->quantity !!}</td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>

            @if(!empty($order->getOrderFlightDetails))
                <div class="tab-pane tab-pane fade" id="service-four">
                    <section class="product-info">
                        @foreach($order->getOrderFlightDetails  as $flight)
                            <div class="panel panel-primary ">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        {{(($flight->flightmode == 1)? 'Outgoing':'Incoming')}} {{Translater::getValue('title-flight-details')}}
                                    </h4>
                                </div>
                                <br />
                                <div class="panel-body">
                                    <table class="table">
                                        <tr><td>{{Translater::getValue('form-title-airline-name')}}</td><td>{{ $flight->airlines_name }}</td></tr>
                                        <tr>
                                            <td>{{Translater::getValue('form-label-departure-airport-name')}}</td>
                                            <td>{{ $flight->departure_airport }}</td>

                                        </tr>
                                        <tr><td>{{Translater::getValue('title-destination-airport')}}</td><td>{{ $flight->arrival_airport }} </td></tr>
                                        <tr>
                                            <td>{{Translater::getValue('form-label-departure-date')}}</td>
                                            <td>{{ date("d-m-Y", strtotime($flight->departure_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{Translater::getValue('form-label-departure-time')}}</td>
                                            <td>{!! $flight->departure_time !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{{Translater::getValue('form-label-arrive-date')}}</td>
                                            <td>{!! date("d-m-Y", strtotime($flight->arrive_date)) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{{Translater::getValue('form-label-arrive-time')}}</td>
                                            <td>{!! $flight->arrive_time !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{{Translater::getValue('form-label-travel-duration')}}</td>
                                            <td>{!! $flight->duration !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{{Translater::getValue('form-label-flight-tickets-needed')}}</td>
                                            <td>{!! $flight->quantity !!}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>
            @endif

            @if($order->getHotelDetails)
                <div class="tab-pane tab-pane fade" id="service-five">
                    <section class="product-info">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>{{Translater::getValue('title-hotel-name')}}</td>
                                    <td>{{ $order->getHotelDetails->hotel_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{Translater::getValue('label-star')}}:</td>
                                    <td>{{ $order->getHotelDetails->star }}</td>
                                </tr>
                                <tr>
                                    <td>{{Translater::getValue('form-label-address')}}:</td>
                                    <td>{{$order->getHotelDetails->address}}</td>
                                </tr>
                                <tr>
                                    <td>{{Translater::getValue('form-label-city')}}:</td>
                                    <td>{{$order->getHotelDetails->city}}</td>
                                </tr>
                                <tr>
                                    <td>{{Translater::getValue('form-label-country')}}:</td>
                                    <td>{{$order->getHotelDetails->country}}</td>
                                </tr>

                                @if($order->getHotelDetails->breakfast_price)
                                    <tr>
                                        <td>{{Translater::getValue('form-label-breakfast')}} : </td>
                                        <td> {{Translater::getValue('label-yes')}}</td>

                                    </tr>
                                    <tr>
                                        <td>{{Translater::getValue('form-label-breakfast-price')}}: </td>
                                        <td> {!! '€'.$order->getHotelDetails->breakfast_price.' p.p.p.n' !!}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{Translater::getValue('form-message-number-of-days-reserved-to-stay-in-hotel')}} : </td>
                                    <td>{{ $order->getHotelDetails->rooms_days }}</td>
                                </tr>
                            </table>
                        </div>
                    </section>
                </div>
            @endif
            @if($order->getOrderOptions)
                <div class="tab-pane tab-pane fade" id="service-six">
                    <section class="product-info">

                        <div class="panel-body">
                            @foreach($order->getOrderOptions as $opt)
                                <div class="panel panel-default">
                                    <div class="panel-body"><h4 >{{ $opt->title }}</h4>
                                        <p class="text-justify">{{$opt->description}}</p>
                                        <div class="pull-right text-right">
                                            &euro; {{ $opt->price }} x &nbsp;&nbsp;{{ $opt->quantity }}&nbsp;({{Translater::getValue('label-quantity')}})
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