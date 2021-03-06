@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
tournament
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Tournaments</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>tournaments</li>
        <li class="active">tournaments</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    tournament {{ $tournament->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $tournament->id }}</td></tr>
                     <tr><td>name</td><td>{{ $tournament['name'] }}</td></tr>
                    <tr><td><h4>Story on difference languages: </h4></td><td></td></tr>
                    @foreach ($tournament->getTranslate as $trans)
                        <tr><td>{{$trans->lang_code}}</td><td>{{$trans->story}}</td></tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@stop