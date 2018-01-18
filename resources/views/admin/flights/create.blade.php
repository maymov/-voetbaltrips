@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New flight
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Flights</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>flights</li>
        <li class="active">Create New flight</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new flight
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => 'admin/flights']) !!}
                         <div class="form-group">
                             {!! Form::label('flightmode', 'Flight Mode: ') !!}
                             {!! Form::select("flightmode", ["1"=>"Outbound", "2"=>"Return"], null, ["class"=>"form-control", "required"=>"required", "placeholder" => "Please pick a Flight Mode"]) !!}
                         </div>
                    <div class="form-group">
                        {!! Form::label('airlines_id', 'Airlines Id: ') !!}
                        {!! Form::select("airlines_id", $airlines, null, ["class"=>"form-control", "required"=>"required", "placeholder" => "Please pick a Airline"]) !!}
                    </div>

					{{--<div class="form-group">
                        {!! Form::label('flight_number', 'Flight Number: ') !!}
                        {!! Form::text('flight_number', null, ['class' => 'form-control', "required"=>"required"]) !!}
                    </div>--}}

					<div class="form-group">
                        {!! Form::label('from', 'From: ') !!}
                        {!! Form::select("from", $airports, null, ["class" => "form-control", "required" => "required", "placeholder"=>"Pick a Source Airport"]) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('to', 'To: ') !!}
                        {!! Form::select("to", $airports, null, ["class" => "form-control", "required" => "required", "placeholder"=>"Pick a Destination Airport"]) !!}
                    </div>
                     <div class="form-group">
                         {!! Form::label('via', 'Via: ') !!}
                         {!! Form::text('via', null, ['class' => 'form-control']) !!}
                     </div>
					<div class="form-group">
                        {!! Form::label('departure_date', 'Departure Date: ') !!}
                        <div class="controls input-append date form_datetime" data-date=""  data-date-format="dd MM yyyy" data-link-field="departure_date">
                                <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select a Date" required="required">
                                <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="add-on"><i class="icon-th"></i></span>
                            </div>
                            <input type="hidden" id="departure_date" name="departure_date" value="" />
                    </div>
					<div class="form-group">
                        {!! Form::label('departure_time', 'Departure Time: ') !!}
                        <div class="controls input-append date departure_time" data-date=""  data-date-format="hh:ii" data-link-field="departure_time">
                            <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select time" required="required">
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                        <input type="hidden" id="departure_time" name="departure_time" value="" />
                    </div>

                         <div class="form-group">
                             {!! Form::label('arrive_date', 'Arrive Date: ') !!}
                             <div class="controls input-append date arrive_date" data-date=""  data-date-format="dd MM yyyy" data-link-field="arrive_date">
                                 <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select a Date" required="required">
                                 <span class="add-on"><i class="icon-remove"></i></span>
                                 <span class="add-on"><i class="icon-th"></i></span>
                             </div>
                             <input type="hidden" id="arrive_date" name="arrive_date" value="" />
                         </div>
					<div class="form-group">
                        {!! Form::label('arrive_time', 'Arrive Time: ') !!}
                        <div class="controls input-append date arrive_time" data-date=""  data-date-format="hh:ii" data-link-field="arrive_time">
                            <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select time" required="required">
                            <span class="add-on"><i class="icon-remove"></i></span>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                        <input type="hidden" id="arrive_time" name="arrive_time" value="" />
                    </div>

					<div class="form-group">
                        {!! Form::label('price', 'Price: ') !!}
                        {!! Form::number('price', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('currency', 'Currency: ') !!}
                        {!! Form::text('currency', "EUR", ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.flights.index') }}">
                                @lang('button.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
                                @lang('button.save')
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
    @section('footer_scripts')
        <script src="{{ asset('assets/js/pages/flights.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>

@stop