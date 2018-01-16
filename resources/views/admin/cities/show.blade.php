@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
city
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Cities</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>cities</li>
        <li class="active">cities</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    city {{ $city->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $city->id }}</td></tr>
                     <tr><td>City Name</td><td>{{ $city['name'] }}</td></tr>
					<tr><td>Country</td><td>{{ $city->country->name }}</td></tr>
					<tr><td><h5>Languages: </h5></td><td></td></tr>
                    @foreach($city->getTranslate as $trans)
                        <tr><td>{{$trans->lang_code}}</td><td>{{$trans->trans_name}}</td></tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop