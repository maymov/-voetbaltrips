@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
payment
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Payments</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>payments</li>
        <li class="active">payments</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    payment {{ $payment->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $payment->id }}</td></tr>
                     <tr><td>invoice_id</td><td>{{ $payment['invoice_id'] }}</td></tr>
					<tr><td>received on</td><td>{{ $payment['received on'] }}</td></tr>
					<tr><td>payment_method_id</td><td>{{ $payment['payment_method_id'] }}</td></tr>
					<tr><td>amount</td><td>{{ $payment['amount'] }}</td></tr>
					<tr><td>notes</td><td>{{ $payment['notes'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop