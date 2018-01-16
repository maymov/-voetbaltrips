@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Create New match
@parent
@stop

{{-- Page content --}}
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
            {!! Form::open(['url' => 'admin/matches', 'enctype'=>'multipart/form-data']) !!}
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create a new match
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

					<div class="form-group">
                        {!! Form::label('tournament', 'Tournament: ') !!}
                        {!! Form::select('tournament', $tournaments, Input::old('tournament'), ['class'=> 'form-control', "required"=>"required"]) !!}
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
                                <input size="16" type="text" value="" readonly class="form-control" placeholder="Please select a Date" required="required">
                                <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="add-on"><i class="icon-th"></i></span>
                            </div>
                            <input type="hidden" id="match_date" name="match_date" value="" /><br/>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label("image", "Match Image") !!}
                        {!! Form::file("image", ["class" => "form-control"]) !!}

                    </div>

                         <h4 class="panel-title" style="background-color: #2b669a; padding: 15px; color:white" > Tickets Informations</h4>

                         <div class="form-group" style="padding-top: 20px">
                             {!! Form::label('discount', 'Discount: ') !!}
                             {!! Form::input('discount', 'discount', Input::old('discount'), ['class'=> 'form-control']) !!}
                         </div>

                         <div class="form-group" style="padding-bottom: 20px">
                             <div class="col-xs-12" style="padding-left: 0">
                                 <h4>Seats of 1 category</h4>
                             </div>
                             <div class="col-xs-6" style="padding-left: 0">
                                 {!! Form::label('quant1', 'Quantity: ') !!}
                                 {!! Form::input('quant1', 'quant1', Input::old('quant1'), ['class'=> 'form-control']) !!}
                             </div>
                             <div class="col-xs-6" style="padding-right: 0">
                                 {!! Form::label('price1', 'Price: ') !!}
                                 {!! Form::input('price1', 'price1', Input::old('price1'), ['class'=> 'form-control']) !!}
                             </div>
                         </div>


                         <div class="form-group">
                             <div class="col-xs-12" style="padding-left: 0">
                                 <h4>Seats of 2 category</h4>
                             </div>
                             <div class="col-xs-6" style="padding-left: 0">
                                 {!! Form::label('quant2', 'Quantity: ') !!}
                                 {!! Form::input('quant2', 'quant2', Input::old('quant2'), ['class'=> 'form-control']) !!}
                             </div>
                             <div class="col-xs-6" style="padding-right: 0">
                                 {!! Form::label('price2', 'Price: ') !!}
                                 {!! Form::input('price2', 'price2', Input::old('price2'), ['class'=> 'form-control']) !!}
                             </div>
                         </div>


                         <div class="form-group">
                             <div class="col-xs-12" style="padding-left: 0">
                                 <h4>Seats of 3 category</h4>
                             </div>
                             <div class="col-xs-6" style="padding-left: 0">
                                 {!! Form::label('quant3', 'Quantity: ') !!}
                                 {!! Form::input('quant3', 'quant3', Input::old('quant3'), ['class'=> 'form-control']) !!}
                             </div>
                             <div class="col-xs-6" style="padding-right: 0; padding-bottom: 20px">
                                 {!! Form::label('price3', 'Price: ') !!}
                                 {!! Form::input('price3', 'price3', Input::old('price3'), ['class'=> 'form-control']) !!}
                             </div>
                         </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('admin.matches.index') }}">
                                @lang('button.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
                                @lang('button.save')
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    <!-- row-->
    @section('footer_scripts')
        <<script src="{{ asset('assets/js/pages/admin_matches.js')}}" type="text/javascript" charset="utf-8" async defer></script>
    @stop
</section>

@stop