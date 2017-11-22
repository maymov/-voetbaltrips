@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New language-key
@parent
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Languages-keys</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>languages</li>
        <li class="active">Create New language-key</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new language-key
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

                    {!! Form::open(['url' => 'admin/language-keys']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
                    </div>
                    @foreach($languages as $lan)
                             <div class="form-group">
                                 {!! Form::label('val_'. strtolower($lan->code), $lan->name) !!}
                                 {!! Form::text('val_'. strtolower($lan->code), null, ['class' => 'form-control', 'required'=>'required']) !!}
                             </div>
                    @endforeach
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
