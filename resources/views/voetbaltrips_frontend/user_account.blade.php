@extends('newtemplate/layout')

{{-- Page title --}}
@section('title')
User Account
@parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/skins/minimal/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.css') }}">

@stop

{{-- Page content --}}
@section('content')
    <div class="container">
        <div class="welcome">
            <h3>{{Translater::getValue('label-my-account-small')}}</h3>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-md-12">
                    <!--main content-->
                    <div class="position-center">
                        <!-- Notifications -->
                        @include('notifications')

                        <div>
                            <h3 class="text-primary">{{Translater::getValue('label-personal-information')}}</h3>
                        </div>
                        <form role="form" id="tryitForm" class="form-horizontal" enctype="multipart/form-data"
                              action="{{ route('my-account') }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{--
                            <div class="form-group">
                                <label class="col-md-2 control-label">Avatar:</label>
                                <div class="col-md-10">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                            @if($user->pic)
                                                <img src="{!! url('/').'/uploads/users/'.$user->pic !!}" alt="img"
                                                     class="img-responsive"/>
                                            @else
                                                <img src="http://placehold.it/200x150" alt="..."
                                                     class="img-responsive"/>
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file">
                                                <span class="fileinput-new">{{Translater::getValue('button-select-image')}}</span>
                                                <span class="fileinput-exists">{{Translater::getValue('button-change')}}</span>
                                                <input type="file" name="pic" id="pic" />
                                            </span>
                                            <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">{{Translater::getValue('button-remove')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            --}}
                            <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                <label class="col-lg-2 control-label">
                                    {{Translater::getValue('form-label-first-name')}}:
                                    <span class='require'>*</span>
                                </label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-user-md text-primary"></i>
                                    </span>
                                        <input type="text" placeholder=" " name="first_name" id="u-name" class="form-control" value="{!! Input::old('first_name',$user->first_name) !!}"></div>
                                    <span class="help-block">{{ $errors->first('first_name', ':message') }}</span>
                                </div>

                            </div>

                            <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                        <label class="col-lg-2 control-label">
                                            {{Translater::getValue('form-label-last-name')}}:
                                            <span class='require'>*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fw fa-user-md text-primary"></i>
                                            </span>
                                                <input type="text" placeholder=" " name="last_name" id="u-name" class="form-control" value="{!! Input::old('last_name',$user->last_name) !!}"></div>
                                            <span class="help-block">{{ $errors->first('last_name', ':message') }}</span>
                                        </div>
                                    </div>

                            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                <label class="col-lg-2 control-label">
                                    {{Translater::getValue('form-label-email')}}:
                                    <span class='require'>*</span>
                                </label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-fw fa-envelope text-primary"></i>
                                        </span>
                                        <input type="text" placeholder=" " id="email" name="email" class="form-control" value="{!! Input::old('email',$user->email) !!}"></div>
                                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                        <p class="text-warning col-md-offset-2"><strong>{{Translater::getValue('label-if-you-do-not-want-to-change-password...')}}</strong></p>
                                        <label class="col-lg-2 control-label">
                                            {{Translater::getValue('form-label-password')}}:
                                            <span class='require'>*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fw fa-key text-primary"></i>
                                            </span>
                                                <input type="password" name="password" placeholder=" " id="pwd" class="form-control"></div>
                                            <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                                        </div>
                                    </div>

                            <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                                        <label class="col-lg-2 control-label">
                                            {{Translater::getValue('form-label-confirm-password')}}:
                                            <span class='require'>*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fw fa-key text-primary"></i>
                                            </span>
                                                <input type="password" name="password_confirm" placeholder=" " id="cpwd" class="form-control"></div>
                                            <span class="help-block">{{ $errors->first('password_confirm', ':message') }}</span>
                                        </div>
                                    </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">{{Translater::getValue('form-label-gender')}}: </label>
                                <div class="col-lg-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="male" @if($user->gender === "male") checked="checked" @endif />
                                            {{Translater::getValue('form-label-male')}}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="female" @if($user->gender === "female") checked="checked" @endif />
                                            {{Translater::getValue('form-label-female')}}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" value="other" @if($user->gender === "other") checked="checked" @endif />
                                            {{Translater::getValue('label-other')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--
                            <div>
                                <h3 class="text-primary">{{Translater::getValue('label-contact')}}: </h3>
                            </div>

                            <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                <label class="col-lg-2 control-label">{{Translater::getValue('form-label-address')}}:</label>
                                <div class="col-lg-6">
                                    <textarea rows="5" cols="30" class="form-control" id="add1" name="address">{!! Input::old('address',$user->address) !!}</textarea>
                                </div>
                                <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                            </div>

                            <div class="form-group {{ $errors->first('country', 'has-error') }}">
                                <label class="control-label  col-md-2">{{Translater::getValue('label-selecteer-land')}}: </label>
                                <div class="col-md-6">
                                    {!! Form::select('country', $countries, $user->country,['class' => 'form-control select2', 'id' => 'countries']) !!}
                                    <span class="help-block">{{ $errors->first('country', ':message') }}</span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('state', 'has-error') }}">
                                <label class="col-lg-2 control-label" for="state">{{Translater::getValue('label-state')}}:</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-fw fa-dot-circle-o text-primary"></i>
                                        </span>
                                        <input type="text" placeholder=" " id="state" class="form-control" name="state"  value="{!! Input::old('state',$user->state) !!}" />
                                    </div>
                                </div>
                                <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                            </div>

                            <div class="form-group {{ $errors->first('city', 'has-error') }}">
                                <label class="col-lg-2 control-label" for="city">{{Translater::getValue('form-label-city')}}:</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-fw fa-dot-circle-o text-primary"></i>
                                        </span>
                                        <input type="text" placeholder=" " id="city" class="form-control" name="city"  value="{!! Input::old('city',$user->city) !!}" />
                                    </div>
                                </div>
                                <span class="help-block">{{ $errors->first('city', ':message') }}</span>
                            </div>

                            <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                                <label class="col-lg-2 control-label" for="postal">{{Translater::getValue('label-postal')}}:</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-fw fa-dot-circle-o text-primary"></i>
                                        </span>
                                        <input type="text" placeholder=" " id="postal" class="form-control" name="postal"  value="{!! Input::old('postal',$user->postal) !!}" />
                                    </div>
                                    <span class="help-block">{{ $errors->first('postal', ':message') }}</span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('dob', 'has-error') }}">
                                <label class="col-lg-2 control-label">
                                    DOB:
                                </label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-calendar text-primary"></i>
                                    </span>
                                    {!!  Form::text('dob', Input::old('dob',$user->dob), array('id' => 'datepicker','class' => 'form-control', 'data-date-format'=> 'yyyy-mm-dd','readonly'=>'readonly'))  !!} </div>
                                    <span class="help-block">{{ $errors->first('dob', ':message') }}</span>
                                </div>
                            </div>
                            --}}
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit">{{Translater::getValue('button-save')}}</button>
                                </div>
                            </div>
                        </form>{{--{!!  Form::close()  !!}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

<script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/select2/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
@stop
