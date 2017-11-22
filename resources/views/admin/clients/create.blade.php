@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New client
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Clients</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>clients</li>
        <li class="active">Create New client</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new client
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

                    {!! Form::open(['url' => 'admin/clients']) !!}

                         <div class="form-group">
                             {!! Form::Label('company_id', 'Company:') !!}
                             {!! Form::select('company_id', $companies, null, ['class' => 'form-control']) !!}
                         </div>

					<div class="form-group">
                        {!! Form::label('client_nr', 'Client Nr: ') !!}
                        {!! Form::text('client_nr', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('email', 'Email: ') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('phone', 'Phone: ') !!}
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('mobile', 'Mobile: ') !!}
                        {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('address_1', 'Address 1: ') !!}
                        {!! Form::text('address_1', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('address_2', 'Address 2: ') !!}
                        {!! Form::text('address_2', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('city', 'City: ') !!}
                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('state', 'State: ') !!}
                        {!! Form::text('state', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('postal_code', 'Postal Code: ') !!}
                        {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('country', 'Country: ') !!}
                        {!! Form::text('country', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('website', 'Website: ') !!}
                        {!! Form::text('website', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('notes', 'Notes: ') !!}
                        {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
                    </div>

					

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.clients.index') }}">
                                @lang('button.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
                                @lang('button.save')
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>

@stop