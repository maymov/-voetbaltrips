@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
airport_city
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Airport_cities</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>airport_cities</li>
        <li class="active">airport_cities</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    airport_city {{ $airport_city->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $airport_city->id }}</td></tr>
                     <tr><td>airport_id</td><td>{{ $airport_city['airport_id'] }}</td></tr>
					<tr><td>city_id</td><td>{{ $airport_city['city_id'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop