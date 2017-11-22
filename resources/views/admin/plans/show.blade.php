@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
plan
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Plans</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>plans</li>
        <li class="active">plans</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    plan {{ $plan->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $plan->id }}</td></tr>
                     <tr><td>title</td><td>{{ $plan['title'] }}</td></tr>
					<tr><td>price</td><td>{{ $plan['price'] }}</td></tr>
					<tr><td>months</td><td>{{ $plan['months'] }}</td></tr>
					<tr><td>active</td><td>{{ $plan['active'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop