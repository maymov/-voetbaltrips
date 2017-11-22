@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
invoice_line
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Invoice_lines</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>invoice_lines</li>
        <li class="active">invoice_lines</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    invoice_line {{ $invoice_line->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $invoice_line->id }}</td></tr>
                     <tr><td>invoice_id</td><td>{{ $invoice_line['invoice_id'] }}</td></tr>
					<tr><td>product_id</td><td>{{ $invoice_line['product_id'] }}</td></tr>
					<tr><td>product_title</td><td>{{ $invoice_line['product_title'] }}</td></tr>
					<tr><td>product_amount</td><td>{{ $invoice_line['product_amount'] }}</td></tr>
					<tr><td>product_vat</td><td>{{ $invoice_line['product_vat'] }}</td></tr>
					<tr><td>product_price</td><td>{{ $invoice_line['product_price'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop