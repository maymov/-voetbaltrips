@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a match
@parent
@stop


@section('content')
<section class="content-header">
    <h1>Matches</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>matches</li>
        <li class="active">Create New match</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit match
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

                    {!! Form::model($match, ['method' => 'PATCH', 'action' => ['MatchesController@update', $match->id], "enctype"=>"multipart/form-data"]) !!}
					<div class="form-group">
                        {!! Form::label('tournament', 'Tournament: ') !!}
                        {!! Form::select('tournament', $tournaments, ((!empty(Input::old('tournament'))) ? Input::old('tournament') : $match->tournament), ['class'=> 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('stadium', 'Stadium: ') !!}
                        {!! Form::select('stadium', $stadia, Input::old('stadium'), ['class'=> 'form-control', "required"=>"required"]) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('home_club', 'Home Club: ') !!}
                        {!! Form::select('home_club', $clubs, Input::old('home_club'), ['class'=> 'form-control', "required"=>"required"]) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('away_club', 'Away Club: ') !!}
                        {!! Form::select('away_club', $clubs, Input::old('away_clubs'), ['class'=> 'form-control', "required"=>"required"]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('fixed_data', 'Is Data Fixed: ') !!}
                        {!! Form::select('fixed_data',[0 => "No", 1 => "Yes"], Input::old('fixed_data'), ['class'=> 'form-control', "required"=>"required"]) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('match_date', 'Match Date: ') !!}
                        <div class="control-group">
                            <div class="controls input-append date form_datetime" data-date=""  data-date-format="dd MM yyyy - HH:ii p" data-link-field="match_date">
                                <input size="16" type="text" value="{{ $match->match_date }}" readonly class="form-control" placeholder="Please select a Date" required="required">
                                <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="add-on"><i class="icon-th"></i></span>
                            </div>
                            <input type="hidden" id="match_date"  name="match_date" value="{{ $match->match_date }}" /><br/>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label("image", "Match Image") !!}
                        {!! Form::file("image", ["class" => "form-control"]) !!}
                    </div>
                    <div class="form-group">
                        <div style="max-width: 100%;" id="image-holder">
                             <img src="{!! url("uploads/matches/".$match->image_name) !!}" class="thumb-image" style="width: 100%;" />
                        </div>
                    </div>

                     <h4 class="panel-title" style="background-color: #2b669a; padding: 15px; color:white" > Tickets Informations</h4>

                     <div class="form-group" style="padding-top: 20px">
                         {!! Form::label('discount', 'Discount: ') !!}
                         {!! Form::input('discount', 'discount', ($discount) ? $discount : 0, ['class'=> 'form-control', "required"=>"required"]) !!}
                     </div>

                     <div class="form-group" style="padding-bottom: 20px">
                         <div class="col-xs-12" style="padding-left: 0">
                            <h4>Seats of 1 category</h4>
                         </div>
                         <div class="col-xs-6" style="padding-left: 0">
                             {!! Form::label('quant1', 'Quantity: ') !!}
                             {!! Form::input('quant1', 'quant1', ($priceArr[1]['quantity']) ? $priceArr[1]['quantity'] : 0, ['class'=> 'form-control', "required"=>"required"]) !!}
                         </div>
                         <div class="col-xs-6" style="padding-right: 0">
                             {!! Form::label('price1', 'Price: ') !!}
                             {!! Form::input('price1', 'price1', ($priceArr[1]['price']) ? $priceArr[1]['price'] : 0, ['class'=> 'form-control', "required"=>"required"]) !!}
                         </div>
                     </div>


                     <div class="form-group">
                         <div class="col-xs-12" style="padding-left: 0">
                             <h4>Seats of 2 category</h4>
                         </div>
                         <div class="col-xs-6" style="padding-left: 0">
                             {!! Form::label('quant2', 'Quantity: ') !!}
                             {!! Form::input('quant2', 'quant2', ($priceArr[2]['quantity']) ? $priceArr[2]['quantity'] : 0, ['class'=> 'form-control', "required"=>"required"]) !!}
                         </div>
                         <div class="col-xs-6" style="padding-right: 0">
                             {!! Form::label('price2', 'Price: ') !!}
                             {!! Form::input('price2', 'price2', ($priceArr[2]['price']) ? $priceArr[2]['price'] : 0, ['class'=> 'form-control', "required"=>"required"]) !!}
                         </div>
                     </div>


                     <div class="form-group">
                         <div class="col-xs-12" style="padding-left: 0">
                            <h4>Seats of 3 category</h4>
                         </div>
                         <div class="col-xs-6" style="padding-left: 0">
                             {!! Form::label('quant3', 'Quantity: ') !!}
                             {!! Form::input('quant3', 'quant3', ($priceArr[3]['quantity']) ? $priceArr[3]['quantity'] : 0, ['class'=> 'form-control', "required"=>"required"]) !!}
                         </div>
                         <div class="col-xs-6" style="padding-right: 0; padding-bottom: 20px">
                             {!! Form::label('price3', 'Price: ') !!}
                             {!! Form::input('price3', 'price3', ($priceArr[3]['price']) ? $priceArr[3]['price'] : 0, ['class'=> 'form-control', "required"=>"required"]) !!}
                         </div>
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
        <<script src="{{ asset('assets/js/pages/admin_matches.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>
@stop