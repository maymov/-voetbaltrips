@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a invoice_line
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
        <li class="active">Create New invoice_line</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit invoice_line
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($invoice_line, ['method' => 'PATCH', 'action' => ['Invoice_linesController@update', $invoice_line->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('invoice_id', 'Invoice Id: ') !!}
                        {!! Form::text('invoice_id', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('product_id', 'Product Id: ') !!}
                        {!! Form::text('product_id', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('product_title', 'Product Title: ') !!}
                        {!! Form::text('product_title', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('product_amount', 'Product Amount: ') !!}
                        {!! Form::text('product_amount', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('product_vat', 'Product Vat: ') !!}
                        {!! Form::text('product_vat', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('product_price', 'Product Price: ') !!}
                        {!! Form::text('product_price', null, ['class' => 'form-control']) !!}
                    </div>

					

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</section>
@stop