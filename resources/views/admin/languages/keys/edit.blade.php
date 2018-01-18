@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit the language-key
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Language-key</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>languages-keys</li>
        <li class="active">Edit language-key</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit Language-key
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

                    {!! Form::model($key, ['method' => 'PATCH', 'action' => ['LanguagesKeysController@update', $key->id ]]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name: ') !!}
                            {!! Form::text('name', $key->name, ['class' => 'form-control']) !!}
                        </div>
                        @foreach($key->getValues as $k)
                            @foreach($key->getLanguages as $l)
                                @if($k->languages_id == $l->id)
                                     <div class="form-group">
                                         {!! Form::label(strtolower($l->id), $l->code. ' :') !!}
                                         {!! Form::text(strtolower($l->id), $k->value, ['class' => 'form-control']) !!}
                                     </div>
                                @endif
                            @endforeach
                        @endforeach

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