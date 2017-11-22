@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New language
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Languages</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>languages</li>
        <li class="active">Create New language</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new language
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

                    {!! Form::open(['url' => 'admin/languages', "enctype"=>"multipart/form-data"]) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("code", "Code:") !!}
                        {!! Form::text('code', null, ['class' => 'form-control', 'required'=>'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <!-- row-->
    @section('footer_scripts')

    @stop
</section>

@stop