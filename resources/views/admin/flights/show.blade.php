@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
flight
@parent
@stop

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
        <li class="active">flights</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    flight {{ $flight->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $flight->id }}</td></tr>
                     <tr><td>airlines_id</td><td>{{ $flight->airline->name }}</td></tr>
					{{--<tr><td>flight_number</td><td>{{ $flight['flight_number'] }}</td></tr>--}}
					<tr><td>from</td><td>{{ $flight->source_airport->title  }}</td></tr>
					<tr><td>to</td><td>{{ $flight->destination_airport->title }}</td></tr>
					<tr><td>departure_date</td><td>{{ $flight['departure_date'] }}</td></tr>
					<tr><td>departure_time</td><td>{{ $flight['departure_time'] }}</td></tr>
                    <tr><td>arrive date</td><td>{{ $flight['arrive_date'] }}</td></tr>
					<tr><td>arrive_time</td><td>{{ $flight['arrive_time'] }}</td></tr>
					<tr><td>duration</td><td>{{ $flight['duration'] }}</td></tr>
					<tr><td>price</td><td>{{ $flight['price'] }}</td></tr>
					<tr><td>currency</td><td>{{ $flight['currency'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop