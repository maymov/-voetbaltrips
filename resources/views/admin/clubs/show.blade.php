@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
club
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Clubs</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>clubs</li>
        <li class="active">clubs</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    club {{ $club->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body" style="align-content: center">
                <div class="club-emblem" style="padding-left: 41%; padding-bottom: 35px">
                    <img src="{{ url("uploads/teamemblems/".$club['emblem'])}}" style="width: 100px; height: 100px"/>
                </div>
                <table class="table">
                    <tr><td>Id</td><td>{{ $club->id }}</td></tr>
                     <tr><td>Name</td><td>{{ $club['name'] }}</td></tr>
					<tr><td>Country</td><td>{{ $club->getCountry->name }}</td></tr>
					<tr><td>City</td><td>{{ $club->getCity->name }}</td></tr>
                    <tr><td><h4>Story for different languages:</h4></td><td></td></tr>
                    @foreach ($languages as $lang)
                        @foreach ($club->getTranslate as $trans)
                            @if($lang->code == $trans->lang_code)
                                <tr><td>{{$trans->lang_code}}</td> <td>{{$trans->story}}</td></tr>
                            @endif
                        @endforeach
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
@stop