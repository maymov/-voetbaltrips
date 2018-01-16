@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
stadium
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Stadium</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>stadia</li>
        <li class="active">Stadium</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    stadium {!! $stadium->id !!}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>Id</td><td>{!! $stadium->id !!} </td></tr>
                    <tr><td>Stadium</td><td>{!! $stadium->stadium !!}</td></tr>
                    <tr><td>Country</td><td>{!! $stadium->country->name !!}</td></tr>
                    <tr><td>City</td><td>{!! $stadium->cities->name !!}</td></tr>
                    <tr><td>Nearest Airport</td><td>{{ $stadium->getNearestAirport->title }}</td></tr>
                    <tr><td>Image</td><td><img src="{!! url('uploads/stadiums/'.$stadium->image) !!}" width="200px;" ></td></tr>
                    <tr><td><h4>Story for different Languages :</h4></td><td></td></tr>
                    @foreach ($stadium->getTranslate as $trans)
                        <tr><td>{{$trans->lang_code}}</td><td>{{$trans->story}}</td></tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop