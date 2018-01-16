@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New city
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Cities</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>cities</li>
        <li class="active">Create New city</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new city
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

                    {!! Form::open(['url' => 'admin/cities']) !!}

					<div class="form-group">
                        {!! Form::label('country_id', 'Country Id: ') !!}
                        {!! Form::select("country_id", $countries, null, ["class"=>"form-control", "placeholder"=>"Please pick a Country", "required"=>"required"]) !!}
                    </div>
                    <div class="form-group">
                         {!! Form::label('name', 'Name: ') !!}
                         {!! Form::text('name', null, ['class' => 'form-control', "required"=>"required"]) !!}
                    </div>

                    <h3>Languages : </h3>

                    @foreach ($languages as $lan)
                             <div class="form-group">
                                 {!! Form::label($lan->code, $lan->code . ': ') !!}
                                 {!! Form::text($lan->code, null, ['class' => 'form-control', "required"=>"required"]) !!}
                             </div>
                    @endforeach

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.cities.index') }}">
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