@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a stadium
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Stadia</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>stadia</li>
        <li class="active">Create New stadium</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit stadium
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

                    {!! Form::model($stadium, ['method' => 'PATCH', 'action' => ['StadiaController@update', $stadium->id], "files" => true]) !!}

                    <div class="form-group">
                        {!! Form::label('stadium', 'Stadium: ') !!}
                        {!! Form::text('stadium', $stadium->stadium, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label("country_id", "Country:") !!}
                        {!! Form::select("country_id", $countries, $stadium->country_id, [
                        "class"        => "form-control", 
                        "placeholder"  => "Please pick a Country", 
                        "required"     => "required", 
                        "id"           => "country_id"
                        ]) !!}
                    </div>
					<div class="form-group">
                        {!! Form::label('city', 'City: ') !!}
                        <select name="city" required="required" id="city" class="form-control">
                            <option value="">Pick a City</option>
                            @foreach($cities as $val)
                                <<option {{ (($stadium->city == $val->id)?'selected="selected"':"")}} value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>
                         <div class="form-group">
                             {!! Form::label('airport', 'Nearest Airport: ') !!}
                             {!! Form::select('airport', $airports, $stadium->nearest_airport, ['class' => 'form-control', "required"=>"required"]) !!}
                         </div>
					<div class="form-group">
                        {!! Form::label('image', 'Image: ') !!}

                        {!! Html::image("uploads/stadiums/".$stadium->image, 'Stadium Image', ["class"=>"thumbnail", "width"=>"200px", "id"=>"preview"]) !!}
                        {!! Form::file('image', null, ['class' => 'form-control', 'id'=>"image"]) !!}

                    </div>
                    <?php $l = '' ;?>
                    @foreach ($languages as $lang)
                         <div class="form-group">
                             {!! Form::label($lang->code, 'Story '.$lang->code.': ') !!}
                             @foreach ($stadium->getTranslate as $trans)
                                 @if ($trans->lang_code == $lang->code)
                                    <?php $l = $trans->story; ?>
                                 @endif
                             @endforeach
                             {!! Form::textarea($lang->code, $l, ['class' => 'form-control', "required" => "required"]) !!}
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
    @section('footer_scripts')
        <<script src="{{ asset('assets/js/pages/stadium.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>
@stop
