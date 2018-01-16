@extends('newtemplate/layout')

@section('header_styles')


    <style>
        /*********************************************
        Call Bootstrap
        *********************************************/

        @import asset("assets/css/frontend/bootstrap.min.css");
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
        </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.css') }}">

@stop

@section('content')

   <section class="content">
        <div class="container">
            <div id="cart_content"></div>
        </div>
        <div class="container">
            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <div class="row">
                <div class="tr1-info">
                    <form method="post" name="frmtravelinfo" id="frmtravelinfo" action="{!! url("tickets/".$match_id."/savetravellerinfo") !!}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" name="total" value="{{$total}}" >
                        @for($x=0; $x<$total;$x++)
                        <div class="panel panel-primary ">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    {{Translater::getValue('form-label-traveller')}} {!! ($x+1) !!} {{Translater::getValue('form-label-information')}}
                                </h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="traveller_first_name">{{Translater::getValue('form-label-first-name-as-per-passport')}}: </label>
                                    {!! Form::text('traveller_first_name['.$x.']', ((isset($travelinfo['traveller_first_name'][$x]))?$travelinfo['traveller_first_name'][$x]:""), ["class"=>"form-control", "id"=>"traveller_first_name", "required"=>"required", "placeholder" => Translater::getValue('form-placeholder-enter-first-name')]) !!}
                                </div>

                                <div class="form-group">
                                    <label for="traveller_last_name">{{Translater::getValue('form-label-last-name-as-per-passport')}}: </label>
                                    {!! Form::text('traveller_last_name['.$x.']', ((isset($travelinfo['traveller_last_name'][$x]))?$travelinfo['traveller_last_name'][$x]:""), ["class"=>"form-control", "id"=>"traveller_last_name", "required"=>"required", "placeholder" => Translater::getValue('form-placeholder-enter-last-name')]) !!}
                                </div>

                                <div class="form-group">
                                    <label for="gender">{{Translater::getValue('form-label-gender')}}:</label>
                                    {!! Form::select("gender[".$x."]", ["male"=>Translater::getValue('form-label-male'), "female"=>Translater::getValue('form-label-female')], ((isset($travelinfo['gender'][$x]))?$travelinfo['gender'][$x]:""), ["class"=>"form-control", "required"=>"required", "id"=>"gender"]) !!}
                                </div>

                                <div class="form-group">
                                    <label for="dtp_input{{$x}}">{{Translater::getValue('form-label-date-of-birth')}}</label>
                                    <div class="input-group date form_dob_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input{{$x}}" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" type="text" value="{{((isset($travelinfo['dob'][$x]))?date("d F Y", strtotime($travelinfo['dob'][$x])):"")}}" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" id="dtp_input{{$x}}" value="{{((isset($travelinfo['dob'][$x]))?$travelinfo['dob'][$x]:"")}}" name="dob[]"/>
                                </div>

                                @if($x == 0)
                                    <div class="form-group">
                                        <label for="traveller_email">{{Translater::getValue('form-label-email')}}: </label>
                                        {!! Form::email('traveller_email['.$x.']', ((isset($travelinfo['traveller_email'][$x]))?$travelinfo['traveller_email'][$x]:""), ["class"=>"form-control", "id"=>"traveller_email", "required"=>"required", "placeholder" => Translater::getValue('form-placeholder-enter-email')]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="traveller_phone">{{Translater::getValue('form-label-phone')}}: </label>
                                        {!! Form::text('traveller_phone['.$x.']', ((isset($travelinfo['traveller_email'][$x]))?$travelinfo['traveller_phone'][$x]:""), ["class"=>"form-control", "id"=>"traveller_phone", "required"=>"required|integer", "placeholder" => Translater::getValue('form-placeholder-enter-phone')]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="traveller_address">{{Translater::getValue('form-label-address')}}:</label>
                                        {!! Form::text('traveller_address['.$x.']', ((isset($travelinfo['traveller_address'][$x]))?$travelinfo['traveller_address'][$x]:""), ["class"=>"form-control", "required"=>"required", "id"=>"traveller_address", "placeholder" => Translater::getValue('form-placeholder-enter-adress')]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="traveller_postcode">{{Translater::getValue('form-label-postcode')}}:</label>
                                        {!! Form::text('traveller_postcode['.$x.']', ((isset($travelinfo['traveller_postcode'][$x]))?$travelinfo['traveller_postcode'][$x]:""), ["class"=>"form-control", "required"=>"required", "id"=>"traveller_postcode", "placeholder" => Translater::getValue('form-placeholder-enter-postcode')]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="traveller_city">{{Translater::getValue('form-label-city')}}:</label>
                                        {!! Form::text('traveller_city['.$x.']', ((isset($travelinfo['traveller_city'][$x]))?$travelinfo['traveller_city'][$x]:""), ["class"=>"form-control", "required"=>"required", "id"=>"traveller_city", "placeholder" => Translater::getValue('form-placeholder-enter-city')]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="traveller_country">{{Translater::getValue('form-label-country')}}:</label>
                                        {!! Form::select("traveller_country[$x]", ["" => Translater::getValue('form-select-choose-country'), "Nederland" => "Nederland", "België" => "België"], ((isset($travelinfo['traveller_country'][$x]))?$travelinfo['traveller_country'][$x]:""), ["class"=>"form-control", "id"=>"traveller_country", "required"=>"required"]) !!}
                                    </div>
                                @endif()
                            </div>
                        </div>
                        @endfor
                        <div class="form-group text-center">
                            <a style="margin-right:10px;" href="{{url("tickets/".$match_id)}}" class="btn btn-info btn-nm">
                                <span class="glyphicon glyphicon-backward"></span> {{Translater::getValue('button-edit-tickets')}}
                            </a>
                            <button type="submit" class="btn btn-success btn-nm">{{Translater::getValue('button-next')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- row-->
        @section('footer_scripts')
            <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
            <script type="text/javascript" src="{{ asset('assets/voetbaltrips_frontend/js/traveller_info.js') }}"></script>
        @stop
    </section>
@stop