@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a airport_city
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Airport_cities</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>airport_cities</li>
        <li class="active">Create New airport_city</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit airport_city
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

                    {!! Form::model($airport_city, ['method' => 'PATCH', 'action' => ['Airport_citiesController@update', $airport_city->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('airport_id', 'Airport Id: ') !!}
                        {!! Form::text('airport_id', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('city_id', 'City Id: ') !!}
                        {!! Form::text('city_id', null, ['class' => 'form-control']) !!}
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