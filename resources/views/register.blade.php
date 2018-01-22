<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Voetbaltrips</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/skins/all.css')}}" />


    <style>
        /*    --------------------------------------------------
	:: Login Section
	-------------------------------------------------- */
        #login {
            padding-top: 50px
        }
        #login .form-wrap {
            width: 30%;
            margin: 0 auto;
        }
        #login h1 {
            color: #1fa67b;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
            padding-bottom: 20px;
            display: inline-block;
        }
        #login .form-group {
            margin-bottom: 25px;
        }
        #login .checkbox {
            margin-bottom: 20px;
            position: relative;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
        #login .checkbox.show:before {
            content: '\e013';
            color: #1fa67b;
            font-size: 17px;
            margin: 1px 0 0 3px;
            position: absolute;
            pointer-events: none;
            font-family: 'Glyphicons Halflings';
        }
        #login .checkbox .character-checkbox {
            width: 25px;
            height: 25px;
            cursor: pointer;
            border-radius: 3px;
            border: 1px solid #ccc;
            vertical-align: middle;
            display: inline-block;
        }
        #login .checkbox .label {
            color: #6d6d6d;
            font-size: 13px;
            font-weight: normal;
        }
        #login .btn.btn-custom {
            font-size: 14px;
            margin-bottom: 20px;
        }
        #login .forget {
            font-size: 13px;
            text-align: center;
            display: block;
        }

        /*    --------------------------------------------------
            :: Inputs & Buttons
            -------------------------------------------------- */
        .form-control {
            color: #212121;
        }
        .btn-custom {
            color: #fff;
            background-color: #1fa67b;
        }
        .btn-custom:hover,
        .btn-custom:focus {
            color: #fff;
        }

        /*    --------------------------------------------------
            :: Footer
            -------------------------------------------------- */
        #footer {
            color: #6d6d6d;
            font-size: 12px;
            text-align: center;
        }
        #footer p {
            margin-bottom: 0;
        }
        #footer a {
            color: inherit;
        }
        #header-languager{
            margin-top: 20px;
            float: right;
            cursor: pointer;
        }
    </style>

    <!--end of page level css-->
</head>
<body>

{{-- getting session user data --}}
<?php

    $userFirstName = "";
    $userLastname = "";
    $userEmail = "";

    if (isset(Session::get('travelinfo')['traveller_first_name'][0])) {
        $userFirstName = Session::get('travelinfo')['traveller_first_name'][0];
    }

    if (isset(Session::get('travelinfo')['traveller_last_name'][0])) {
        $userLastname = Session::get('travelinfo')['traveller_last_name'][0];
    }

    if (isset(Session::get('travelinfo')['traveller_email'][0])) {
        $userEmail = Session::get('travelinfo')['traveller_email'][0];
    }
?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Info!</strong> This alert box indicates a neutral informative change or action.
                </div>

                <div class="form-wrap">
                {{--<img src="{{ asset('assets/images/josh-new.png') }}" alt="logo" class="img-responsive mar">--}}
                <h1 class="text-primary">{{ucfirst(Translater::getValue('label-register-small'))}}</h1><a id="header-languager" class="header-languager">{{\Illuminate\Support\Facades\Session::get('lang_code')}}</a>
                <!-- Notifications -->
                @include('notifications')
                @if($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form class="omb_loginForm" action="{{ route('register') }}" method="POST">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                        <label class="sr-only"> First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{Translater::getValue('form-label-first-name')}}" value="{!! null !== Input::old('first_name') ? Input::old('first_name') : $userFirstName !!}" required>
                        {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                        <label class="sr-only"> Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{Translater::getValue('form-label-last-name')}}" value="{!! null !== Input::old('last_name') ? Input::old('last_name') : $userLastname !!}" required>
                        {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                        <label class="sr-only"> Eemail</label>
                        <input type="email" class="form-control" id="Email" name="email" placeholder="{{Translater::getValue('form-label-email')}}" value="{!! null !== Input::old('Email') ? Input::old('Email') : $userEmail !!}" required>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->first('password', 'has-error') }}">
                        <label class="sr-only"> Password</label>
                        <input type="password" class="form-control" id="Password1" name="password" placeholder="{{Translater::getValue('form-label-password')}}">
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                        <label class="sr-only"> {{Translater::getValue('form-label-confirm-password')}}</label>
                        <input type="password" class="form-control" id="Password2" name="password_confirm"
                               placeholder="{{Translater::getValue('form-label-confirm-password')}}">
                        {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                        <label class="sr-only">{{Translater::getValue('form-label-gender')}}</label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" required="required" id="inlineRadio1" value="male"> {{Translater::getValue('form-label-male')}}
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" required="required" id="inlineRadio2" value="female"> {{Translater::getValue('form-label-female')}}
                        </label>
                        {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="subscribed" >  {{Translater::getValue('form-label-i-accept')}} <a href="https://voetbaltrips.com/algemene-voorwaarden" target="_blank"> {{Translater::getValue('footer-terms-and-conditions-label')}}</a>
                        </label>
                    </div>
                    <input type="submit" class="btn btn-block btn-primary" value="{{Translater::getValue('button-sign-up')}}" name="submit">
                    {{Translater::getValue('form-label-already-have-an-account')}} {{Translater::getValue('form-label-please')}} <a href="{{ route('login') }}"> {{Translater::getValue('form-label-sign-in')}}</a>
                </form>
            </div>
            </div>
            </div>
        </div>
    </div> <!-- /.container -->
</section>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>&copy; Voetbaltrips.nl 2016</p>
            </div>
        </div>
    </div>
</footer>

<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/icheck.min.js') }}"></script>
<!--global js end-->
<script>
    $(document).ready(function(){
        $('#header-languager').on('click', function() {
            $.ajax({
                url: '/ajax/language',
                method: "POST",
                dataType: "json",
                data: {"_token": $("[name=_token]").val()},
                success: function (resp) {
                    if (resp.status == "success") {
                        window.location.reload()
                    } else {
                        Lobibox.notify("error",
                            {
                                msg: resp.message
                            }
                        );
                    }
                }
            });
        });
    });

    function showPassword() {
        var key_attr = $('#key').attr('type');

        if (key_attr != 'text') {
            $('.checkbox').addClass('show');
            $('#key').attr('type', 'text');
        } else {
            $('.checkbox').removeClass('show');
            $('#key').attr('type', 'password');
        }
    }
</script>
</body>
</html>
