@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
invoice
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Invoices</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>invoices</li>
        <li class="active">invoices</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    invoice {{ $invoice->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $invoice->id }}</td></tr>
                     <tr><td>client_id</td><td>{{ $invoice['client_id'] }}</td></tr>
					<tr><td>status</td><td>{{ $invoice['status'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop