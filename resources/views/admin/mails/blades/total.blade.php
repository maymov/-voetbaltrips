<!DOCTYPE html>
<html lang="en">
<head>
</head>

<body>
<div class="header-wrap">
    <div class="header-wrap__backlog"></div>
    <header>
        <!-- Icon Section Start -->
        <div class="container">
            <div class="header__content-wrap">
                <div class="row">
                    <div class="col-md-12 header__content" style="background-color: #2567b1; height: 95px">
                        <div class="slicknav_menu">
                            <a href="#" aria-haspopup="true" tabindex="0" class="slicknav_btn" id="main_menu" style="outline: none;"><span class="slicknav_menutxt"></span><span    class="slicknav_icon slicknav_no-text"><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"    ></span></span>
                            </a>
                        </div>
                        <div class="logo logo--image">
                            <a id="logoLink" href="/">
                                <img style="vertical-align: middle; padding-top: 20px" id="normalImageLogo" src="{{asset('assets/newtemplate/images/logo.png')}}" alt="Voetbaltrips.com" title="Uw voetbalreis voor een sportieve prijs!">
                            </a>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
<div class="container">
    <div class="row">
        <div style="font-size: 14px; line-height: 2" class="col-lg-12">
            <span><h3>{{Translater::getValue('email_start_mess')}} {{$content['full_name']}},</h3></span>
            <span>{{$content['message']}}{{--  : <h4>{{$content['total']}}.</h4> --}}</span>
            {{--<span><h4>Your order:</h4></span>--}}
            {{--<span><h4>{{$content['match_name']}} </h4></span>--}}
            {{--<span><h4>Flights: </h4></span>--}}
            {{--<span><h5>Dep: {{$content['fly_dept']}} </h5></span>--}}
            {{--<span><h5>Arr: {{$content['fly_arr']}} </h5></span>--}}
            {{--<span><h4>Hotel: </h4><h5>{{$content['accom_name']}}</h5></span>--}}
        </div>
    </div>
</div>


</body>

</html>
