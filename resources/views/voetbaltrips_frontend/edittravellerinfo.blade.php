@extends('newtemplate/layout')

@section('header_styles')


    <style>
        /*********************************************
        Call Bootstrap
        *********************************************/

        @import asset("assets/css/frontend/bootstrap.min.css");
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
    </style>
@stop

@section('content')


    <section class="content">
        <div class="container">
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" name="frmtravelinfo" id="frmtravelinfo" action="{!! url("match/".$match_id."/savetravellerinfo") !!}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="hidden" name="total" value="{{$total}}" >
                        @for($x=0; $x<$total;$x++)
                            <div class="panel panel-primary ">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <i class="livicon" data-name="plus-alt" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        Traveller {!! ($x+1) !!} Information
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="name">Full name (as per passport): </label>
                                        {!! Form::text('traveller_name['.$x.']', $travelinfo['traveller_name'][$x], ["class"=>"form-control", "id"=>"traveller_name", "required"=>"required"]) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="dtp_input2">Date of Birth</label>
                                        <div class="input-group date form_dob_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input{{$x}}" data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" value="{{ date("d F Y", strtotime($travelinfo['dob'][$x]))}}" readonly>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <input type="hidden" id="dtp_input{{$x}}" value="{{$travelinfo['dob'][$x]}}" name="dob[]"/><br/>
                                    </div>
                                    <div class="form-group">
                                        <label for="airlines_id">Gender:</label>
                                        {!! Form::select("gender[".$x."]", ["male"=>"Male", "female"=>"Female"], $travelinfo['gender'][$x], ["class"=>"form-control", "required"=>"required", "id"=>"gender"]) !!}
                                    </div>
                                </div>
                            </div>
                        @endfor
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- row-->
        @section('footer_scripts')
            <script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
            <<script src="{{ asset('assets/voetbaltrips_frontend/js/traveller_info.js')}}" type="text/javascript" charset="utf-8" async defer></script>
        @stop
    </section>
@stop