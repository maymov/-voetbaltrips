@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Tickets
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Tickets</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>tickets</li>
        <li class="active">Tickets</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    competition_seating {{ $competition_seating->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $competition_seating->id }}</td></tr>

					<tr><td>Match</td><td>{!! $competition_seating->getMatch->getHomeClub->name  !!} - {!! $competition_seating->getMatch->getAwayClub->name !!}</td></tr>
					<tr><td>price</td><td>{{ $competition_seating['price'] }}</td></tr>
					<tr><td>Seating Category</td><td>{{ $competition_seating->seatingCategory->name }}</td></tr>
					<tr><td>quantity_available</td><td>{{ $competition_seating['quantity_available'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop