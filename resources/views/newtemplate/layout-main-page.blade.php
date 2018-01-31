<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Voetbaltrips</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/newtemplate/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/voetbaltrips_frontend/css/stylish-portfolio.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/newtemplate/css/custom.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('assets/voetbaltrips_frontend/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito%3A400normal%2C700normal&ver=4.7.5" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.CSS">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.loadingModal.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/lobibox.min.css') }}" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css">
    <style>
        #header-languager:hover{
            text-decoration:none;
            cursor:pointer;
        }
    </style>
    @yield('header_styles')
</head>

<body>
<meta name="modal_token" content="{{ csrf_token() }}">
<div class="modal fade" id="myModalCart" role="dialog">
    <div class="modal-dialog" id="modalMatch">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modalHeader">{{Translater::getValue('modal-label-question')}}</h4>
            </div>
            <div class="modal-body">
                <div class="modal-ielem col-sm-2">
                    <i class="fa fa-question-circle"></i>
                </div>
                <p>{{Translater::getValue('modal-text-are-you-sure-you-want-empty-cart')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="modal-confirm" class="btn btn-success" data-dismiss="modal">{{Translater::getValue('label-yes')}}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{Translater::getValue('label-no')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog" id="modalMatch">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modalheader2">text</h4>
            </div>
            <div class="modal-body">
                <div class="modal-ielem col-sm-2">
                    <i id="i-question" class="fa fa-question-circle"></i>
                    <i id="i-inform" class="fa fa-info-circle" style="display: none"></i>
                </div>
                <p id="modaltext2">text</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="modal2-confirm" class="btn btn-success" data-dismiss="modal">{{Translater::getValue('label-yes')}}</button>
                <button type="button" id="modal2-no" class="btn btn-danger" data-dismiss="modal">{{Translater::getValue('label-no')}}</button>
                <button type="button" id="modal2-ok" class="btn btn-default" style="display: none" data-dismiss="modal">Ok</button>
            </div>
        </div>

    </div>
</div>


<div class="header-wrap">
    <div class="header-wrap__backlog" style="min-height: 95px; margin-top: 45px;"></div>
    <header>
        <!-- Icon Section Start -->
        <div class="container">
            <div class="header__info">
                <div class="header__info__items-left">
                    <div class="header__info__item header__info__item--phone"><i class="fa fa-phone"></i>030-3690059</div>
                    <div class="header__info__item header__info__item--clock"><i class="fa fa-clock-o"></i>9:00 - 17:00</div>
                </div>
                <div class="header__info__items-right">
                    <div class="header__info__item header__info__item--delimiter header__info__item--social-icons"><a href="http://facebook.com/voetbaltrips"><i class="fa fa-facebook"></i></a></div>
                    <div class="header__info__item header__info__item--delimiter header__info__item--search"><a data-effect="mfp-zoom-in" class="popup-search-form" href="#search-form-header"><i class="fa fa-search"></i></a></div>
                    <div class="header__info__item header__info__item--delimiter header__info__item--language"><a id="header-languager" class="header-languager">{{\Illuminate\Support\Facades\Session::get('lang_code')}}</a></div>
                </div>
            </div>
            <div class="header__content-wrap">
                <div class="row content-list">
                    <div class="col-md-12 header__content">
                        <div class="slicknav_menu">
                            <a href="#" aria-haspopup="true" tabindex="0" class="slicknav_btn" id="main_menu" style="outline: none;"><span class="slicknav_menutxt"></span><span    class="slicknav_icon slicknav_no-text"><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"    ></span></span>
                            </a>
                        </div>
                        <div class="logo logo--image">
                            <a id="logoLink" href="/@if(isset($home)){{$home}}@endif" >
                                <img id="normalImageLogo" src="{{asset('assets/newtemplate/images/logo.png')}}" alt="Voetbaltrips.com" title="Uw voetbalreis voor een sportieve prijs!">
                            </a>
                        </div>
                        <nav class="main-nav-header" role="navigation">
                            <ul id="navigation" class="main-nav">
                                {{--based on anyone login or not display menu items--}}
                                @if(Sentinel::guest())
                                    <li><a class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item" href="{{ URL::to('login') }}">{{Translater::getValue('label-login-small')}}</a>
                                    </li>
                                    <li><a class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item" href="{{ URL::to('register') }}">{{Translater::getValue('label-register-small')}}</a>
                                    </li>
                                    <!--                                            <li class="phone"><button class="call-to"><div class="bel-ons">Bel ons: 030 - 3690059</div><div class="tussen">TUSSEN 9.00 - 17.00 UUR</div></button></li>-->

                                @else
                                    <li class="dropdown {!! (Request::is('my-account') || Request::is('my-orders') ? 'active' : '') !!}"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{Translater::getValue('label-my-account-small')}} <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ URL::to('my-account') }}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item">{{Translater::getValue('label-my-account-small')}}</a>
                                            </li>
                                            <li><a href="{{ URL::to('my-orders') }}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item">{{Translater::getValue('label-my-orders')}}</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li><a href="{{ URL::to('logout') }}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item current_page_item">{{Translater::getValue('label-logout-small')}}</a>
                                    </li>
                            @endif
                            {{--<li><h1> <span style="cursor: pointer;" class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge top-cart-price"></span></span></h1></li>--}}
                            <!--                                         <li>
                                            <a class="top-cart-price"></a>
                                        </li> -->
                            </ul>


                        </nav>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row content-call">
                    <div class="phone"><button class="call-to"><div class="bel-ons">Bel ons: 030 - 3690059</div><div class="tussen">TUSSEN 9.00 - 17.00 UUR</div></button></div>
                </div>
            </div>
        </div>
    </header>
</div>
@yield('content')

<div id="load_popup_modal_show_id" class="modal fade" tabindex="-1"></div>
<!-- Call to Action -->

<!-- new footer -->

<footer class="footer navbar-fixed-bottom">
    <div class="footer__bottom">
        <div class="footer__arrow-top"><a href="#"><i class="fa fa-chevron-up"></i></a></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer__copyright">© Voetbaltrips.com 2017 {{Translater::getValue('footer-rights-label')}}</div>
                </div>
                <div class="col-md-6">
                    <div class="footer-nav">
                        <ul id="menu-footer-menu" class="menu"><li id="menu-item-1226" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1226"><a href="https://voetbaltrips.com/algemene-voorwaarden">{{Translater::getValue('footer-terms-and-conditions-label')}}</a></li>
                            <li id="menu-item-1227" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1227"><a href="https://voetbaltrips.com/privacy-cookies">Privacy &amp; Cookies</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="{{ asset('assets/voetbaltrips_frontend/js/jquery.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/voetbaltrips_frontend/js/bootstrap.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.loadingModal.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/lobibox.min.js')}}" type="text/javascript"></script>
<!-- Custom Theme JavaScript -->
<script>

    $(document).ready(function(){
        // Closes the sidebar menu
        $("#menu-close").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });

        // Opens the sidebar menu
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });

        // Scrolls to the selected menu item on the page
        $(function() {
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });

        // open main menu
        $('#main_menu').click(function(){
            $('.main-nav').slideToggle(200);
            $('.slicknav_btn').toggleClass('slicknav_btn--close');
        });
    })

</script>
<script src="{{ asset('assets/newtemplate/js/custom.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        Lobibox.base.DEFAULTS = $.extend({}, Lobibox.base.DEFAULTS, {
            iconSource: 'fontAwesome',
            soundPath : "<?=url('assets/sounds')?>/"
        });
        Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
            iconSource: 'fontAwesome',
            soundPath : "<?=url('assets/sounds')?>/"
        });
    });

    $(document).ready(function(){
        var $modal = $('#load_popup_modal_show_id');
        $('.my-cart-icon').on('click', function(){
            $modal.load('{!! url('mycart-popup') !!}', {'_token': $("[name=_token]").val()},
                function(){
                    $modal.modal('show');
                });
        });

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
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/589f4561ac3fa248b6466329/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '622531254567424');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=622531254567424&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->

</script>
<!--End of Tawk.to Script-->

@yield('footer_scripts')
</body>

</html>
