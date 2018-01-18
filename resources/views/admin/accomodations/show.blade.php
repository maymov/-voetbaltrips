@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
accomodation
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Accomodations</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>accomodations</li>
        <li class="active">accomodations</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    accomodation {{ $accomodation->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $accomodation->id }}</td></tr>
                    <tr><td>Hotel Name</td><td>{{ $accomodation->name }}</td></tr>
                    <tr><td>Address</td><td>{{ $accomodation->address }}</td></tr>
                    <tr><td>Country</td><td>{{ $accomodation->country->name }}</td></tr>
                     <tr><td>city</td><td>{{ $accomodation->cityobj->name }}</td></tr>
					<tr><td>stars</td><td>{{ $accomodation['stars'] }}</td></tr>
					<tr><td>high_season_prices</td><td>{{ $accomodation['high_season_prices'] }}</td></tr>
					<tr><td>low_season_prices</td><td>{{ $accomodation['low_season_prices'] }}</td></tr>
					<tr><td>options</td><td>{{ $hotelOptions }}</td></tr>
					<tr><td>breakfast_price</td><td>{{ $accomodation['breakfast_price'] }}</td></tr>
					<tr><td>images</td><td> @foreach($accomodation->images as $image)
                            {!! Html::image("uploads/hotel/".$image->image, 'Hotel Image', ["class"=>"thumbnail", "width"=>"200px", "id"=>"preview"]) !!}
                        @endforeach</td></tr>
                    <tr><td><h4>Description For Different Languages</h4></td><td></td></tr>
                    @foreach ($accomodation->getTranslate as $trans)
                        <tr><td>{{$trans->lang_code}}</td><td>{{ $trans->description }}</td></tr>
                    @endforeach
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop