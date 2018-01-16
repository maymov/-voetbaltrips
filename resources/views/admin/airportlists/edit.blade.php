@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a airportlist
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Airportlists</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>airportlists</li>
        <li class="active">Create New airportlist</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit airportlist
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

                    {!! Form::model($airportlist, ['method' => 'PATCH', 'action' => ['AirportlistsController@update', $airportlist->id]]) !!}

                         <div class="form-group">
                             {!! Form::label("country_id", "Country:") !!}
                             {!! Form::select("country_id", $countries, $country_id, [
                             "class"        => "form-control",
                             "placeholder"  => "Please pick a Country",
                             "required"     => "required",
                             "id"           => "country"
                             ]) !!}
                         </div>
                         <div class="form-group">
                             {!! Form::label('city_id', 'City: ') !!}
                             <select name="city_id" required="required" id="city" class="form-control">
                                 <option value="">Pick a City</option>
                                 @foreach($cities as $val)
                                     <option {!! (($city_id == $val->id)?'selected="selected"':"")!!} value="{!! $val->id !!}">
                                         {!! $val->name !!}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

					<div class="form-group">
                        {!! Form::label('title', 'Title: ') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('iata_code', 'Iata Code: ') !!}
                        {!! Form::text('iata_code', null, ['class' => 'form-control']) !!}
                    </div>
                         <div class="form-group">
                             {!! Form::label('showinsearch', 'Show in search of Flights in Front end: ') !!}
                             {!! Form::radio('showinsearch', "1", (($airportlist->showinsearch ==1)?true:false), ['class' => '']) !!} Yes
                             {!! Form::radio('showinsearch', "0", (($airportlist->showinsearch ==0)?true:false), ['class' => '']) !!} No
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
        <<script src="{{ asset('assets/js/pages/clubs.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>
@stop