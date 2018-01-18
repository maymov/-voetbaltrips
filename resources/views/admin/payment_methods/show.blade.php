@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
payment_method
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Payment_methods</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>payment_methods</li>
        <li class="active">payment_methods</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    payment_method {{ $payment_method->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $payment_method->id }}</td></tr>
                     <tr><td>name</td><td>{{ $payment_method['name'] }}</td></tr>
					<tr><td>default</td><td>{{ $payment_method['default'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop