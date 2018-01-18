@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a payment
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
        <li class="active">Create New payment</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit payment
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

                    {!! Form::model($payment, ['method' => 'PATCH', 'action' => ['PaymentsController@update', $payment->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('invoice_id', 'Invoice Id: ') !!}
                        {!! Form::text('invoice_id', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('received on', 'Received On: ') !!}
                        {!! Form::text('received on', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('payment_method_id', 'Payment Method Id: ') !!}
                        {!! Form::text('payment_method_id', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('amount', 'Amount: ') !!}
                        {!! Form::text('amount', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('notes', 'Notes: ') !!}
                        {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
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