@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a city
@parent
@stop


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
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit city
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

                    {!! Form::model($city, ['method' => 'PATCH', 'action' => ['CitiesController@update', $city->id]]) !!}
                         <div class="form-group">
                             {!! Form::label('country_id', 'Country Name: ') !!}
                             {!! Form::select("country_id", $countries, $city->country_id, ["class"=>"form-control", "placeholder"=>"Please pick a Country", "required"=>"required"]) !!}
                         </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', "required"=>"required"]) !!}
                    </div>
                         <?php $l = ''; ?>
                    @foreach ($languages as $lan)
                        <div class="form-group">
                            {!! Form::label($lan->code, $lan->code . ': ') !!}
                            @foreach ($city->getTranslate as $trans)
                                @if ($trans->lang_code == $lan->code)
                                    <?php $l = $trans->trans_name; ?>
                                @endif
                            @endforeach
                            {!! Form::text($lan->code, $l, ['class' => 'form-control', "required"=>"required"]) !!}
                        </div>
                    @endforeach
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