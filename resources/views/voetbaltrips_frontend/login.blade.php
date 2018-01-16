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
            float: right;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>

    <!--end of page level css-->
</head>
<body>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">

                    <h1>{{Translater::getValue('login-form-label-login with your account')}}</h1>
                    <a id="header-languager" class="header-languager right">{{\Illuminate\Support\Facades\Session::get('lang_code')}}</a>

                    @include('notifications')

                    <form action="{{ route('login') }}" class="omb_loginForm"  autocomplete="off" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                            <label for="email" class="sr-only">{{Translater::getValue('form-label-email')}}</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="">
                        </div>
                        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                        <div class="form-group {{ $errors->first('password', 'has-error') }}">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="">
                        </div>
                        <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">{{Translater::getValue('form-label-show-password')}}</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="{{ucfirst(Translater::getValue('label-login-small'))}}">
                        {{Translater::getValue('form-label-do-not-have-an-account')}} <a href="{{ route('register') }}"><strong> {{Translater::getValue('button-sign-up')}}</strong></a>
                    </form>
                    <a href="{{ route('forgot-password') }}">{{Translater::getValue('form-label-forgot-password')}}</a>
                    <hr>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
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
