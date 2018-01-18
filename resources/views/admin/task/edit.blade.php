@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a club
@parent
@stop


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
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit club
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

                    {!! Form::model($club, ['method' => 'PATCH', 'action' => ['ClubsController@update', $club->id], "enctype"=>"multipart/form-data"]) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Name: ') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
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
                                 <option {!! (($city_id == $val->id)?'selected="selected"':"")!!} value="{!! $val->id !!}">
                                     {!! $val->name !!}
                                 </option>
                            @endforeach
                        </select>
                        </div>
                         <div class="form-group">
                             {!! Form::label("emblem", "Emblem: ") !!}
                             {!! Form::file("emblem", ["class" => "form-control"]) !!}
                         </div>
                         <div class="form-group">
                             <div style="max-width: 100%;" id="image-holder">
                                 <img src="{{url("uploads/teamemblems/".$club->emblem)}}" class="thumb-image" style="width: 100px; height: 100px" />
                             </div>
                         </div>

                         @foreach ($languages as $lang)
		                     <?php $club_l = ''; ?>
                             <div class="form-group">
                                 {!! Form::label($lang->code, 'Story '.$lang->code.': ') !!}
                                 @foreach ($club->getTranslate as $trans)
                                    @if ($lang->code == $trans->lang_code)
                                        <?php $club_l = $trans->story; ?>
                                    @endif
                                 @endforeach
                                 {!! Form::textarea($lang->code, $club_l, ['class' => 'form-control']) !!}
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
        <<script src="{{ asset('assets/js/pages/clubs.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>
@stop