@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create New club
    @parent
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Clubs</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>clubs</li>
            <li class="active">Create New club</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create a new club
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

                        {!! Form::open(['url' => 'admin/clubs', "enctype"=>"multipart/form-data"]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name: ') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label("country", "Country:") !!}
                            {!! Form::select("country", $countries, $country_id, [
                                    "class"        => "form-control",
                                    "placeholder"  => "Please pick a Country",
                                    "required"     => "required",
                                    "id"           => "country"
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('city', 'City: ') !!}
                            <select name="city" required="required" id="city" class="form-control">
                                <option value="">Pick a City</option>
                                @foreach($cities as $val)
                                    <option {!! (($city_id == $val->id)?'selected="selected"':"")!!} value="{!! $val->id !!}">{!! $val->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {!! Form::label("emblem", "Emblem: ") !!}
                            {!! Form::file("emblem", ["class" => "form-control"]) !!}
                        </div>

                        @foreach ($languages as $lang)
                            <div class="form-group">
                                {!! Form::label($lang->code, 'Story '.$lang->code.': ') !!}
                                {!! Form::textarea($lang->code, null, ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        @endforeach

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ route('admin.clubs.index') }}">
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
        @section('footer_scripts')
            <<script src="{{ asset('assets/js/pages/clubs.js')}}" type="text/javascript" charset="utf-8" async defer></script>
        @stop
    </section>

@stop