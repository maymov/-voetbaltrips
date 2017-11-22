@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a language
@parent
@stop


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
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit Language
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

                    {!! Form::model($language, ['method' => 'PATCH', 'action' => ['LanguagesController@update', $language->id]]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name: ') !!}
                            {!! Form::text('name', $language->name, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group inline">
                             {!! Form::label('main', 'Is Main: ') !!}
                             {!! Form::select('main', [1 => 'Yes', 0 => 'No'], $language->is_main, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    @section('footer_scripts')

    @stop
</section>
@stop