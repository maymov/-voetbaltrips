@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a accomodation
@parent
@stop

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" media="all" href="{{ asset('assets/css/star-rating.min.css')}}">
@stop
@section('content')
<section class="content-header">
    <h1>Accomodations</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>accomodations</li>
        <li class="active">Create New accomodation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit accomodation
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

                    {!! Form::model($accomodation, ['method' => 'PATCH', 'action' => ['AccomodationsController@update', $accomodation->id], 'enctype'=> 'multipart/form-data', 'novalidate']) !!}

                     <div class="form-group">
                         {!! Form::label('name', 'Hotel Name: ') !!}
                         {!! Form::text("name", null, ["class"=>"form-control","required"=>"required"]) !!}
                     </div>
                     <div class="form-group">
                         {!! Form::label('address', 'Address: ') !!}
                         {!! Form::text("address", null, ["class"=>"form-control", "required"=>"required"]) !!}
                     </div>
                         <div class="form-group">
                             {!! Form::label("country_id", "Country:") !!}
                             {!! Form::select("country_id", $countries, $country_id, [
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
                                 <option {{ (($city_id == $val->id)?'selected="selected"':"")}} value="{{ $val->id }}">{{ $val->name }}</option>
                             @endforeach
                         </select>
                     </div>
					<div class="form-group">
                        {!! Form::label('stars', 'Stars: ') !!}
                        <input id="rating-system" type="number" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $accomodation->stars }}" name="stars" required="required" />
                    </div>

					<div class="form-group">
                        {!! Form::label('high_season_prices', 'High Season Prices: ') !!}
                        {!! Form::text('high_season_prices', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('low_season_prices', 'Low Season Prices: ') !!}
                        {!! Form::text('low_season_prices', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('options', 'Options: ') !!}
                        {!! Form::text('options', ($options) ? $options : '', ['class' => 'form-control', "required"=>"required", "data-role"=> "tagsinput"]) !!}
                    </div>

                    <div class="form-group">
                         {!! Form::label("option_select", "Add New Option: ") !!}
                         {!! Form::select("option_select", $hotelOptions, '', [
                             "class"        => "form-control",
                             "placeholder"  => "Choose new Option",
                         ]) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('breakfast_price', 'Breakfast Price: ') !!}
                        {!! Form::text('breakfast_price', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('images', 'Images: ') !!}
                        @foreach($accomodation->images as $image)
                            {!! Html::image("uploads/hotel/".$image->image, 'Hotel Image', ["class"=>"thumbnail", "width"=>"200px", "id"=>"preview"]) !!}
                            <button id="remove_{{$image->id}}" type="button" onclick="remove({{$image->id}})" class="btn btn-danger" style="margin-top: -20px;" >Remove</button>
                        @endforeach
                        <br><br>
                        <div id="imgInput">
                            <button type="button" class="btn btn-success" id='addMoreImg'>Add more</button>
                            {!! Form::file('images[]', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <?php $l = ''; ?>
                    @foreach ($languages as $lang)
					<div class="form-group">
                        {!! Form::label($lang->code, 'Description For '.$lang->code.': ') !!}
                        @foreach ($accomodation->getTranslate as $trans)
                            @if ($trans->lang_code == $lang->code)
                                <?php $l = $trans->description ?>
                            @endif
                        @endforeach
                        {!! Form::textarea($lang->code, $l, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    @endforeach
                    <input type="hidden" id="removedImages" name="removedImages">
                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    @section('footer_scripts')
        <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/star-rating.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/stadium.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/hotel-options.js')}}" type="text/javascript"></script>

        <script type="text/javascript">

            $( document ).ready(function() {
                $("#addMoreImg").click(function(){
                    $('<input>').attr({
                        type: 'file',
                        name: 'images[]',
                        class: 'form-control'
                    }).appendTo('#imgInput');
                });
            });



                function remove(id) {
                    if (confirm("Are you sure you want to remove this image?")) {
                        var name = "#remove_"+id;
                        var removed = $("#removedImages").val()+","+id
                        $("#removedImages").val(removed);
                        $(name).prop('disabled', true);
                    }
                }
        </script>
    @stop
</section>
@stop