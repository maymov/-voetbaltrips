@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
airportlist
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Airportlists</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>airportlists</li>
        <li class="active">airportlists</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    airportlist {{ $airportlist->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $airportlist->id }}</td></tr>
                     <tr><td>country_id</td><td>{{ $airportlist['country_id'] }}</td></tr>
					<tr><td>city_id</td><td>{{ $airportlist['city_id'] }}</td></tr>
					<tr><td>title</td><td>{{ $airportlist['title'] }}</td></tr>
					<tr><td>iata_code</td><td>{{ $airportlist['iata_code'] }}</td></tr>
                    <tr><td>SHow in Search </td><td>{{ (($airportlist['showinsearch'] ==1)? 'Yes':'No') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop