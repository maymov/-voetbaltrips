<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            | Voetbaltrips
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/styles/black.css') }}" rel="stylesheet" type="text/css" id="colorscheme"/>
    <link href="{{ asset('assets/css/panel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/metisMenu.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.loadingModal.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/lobibox.min.css') }}" type="text/css">
    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
            <!--end of page level css-->
</head>

<body class="skin-josh">
<header class="header">
    <a href="{{ route('dashboard') }}" class="logo">
        {{--<img src="{{ asset('assets/img/logo.png') }}" alt="logo">--}}
        <h1 style="font-size: 30px;">Voetbaltrips</h1>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                {{--<li class="dropdown messages-menu">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon"--}}
                                                                                   {{--data-name="message-flag"--}}
                                                                                   {{--data-loop="true" data-color="#42aaca"--}}
                                                                                   {{--data-hovercolor="#42aaca"--}}
                                                                                   {{--data-size="28"></i>--}}
                        {{--<span class="label label-success">4</span>--}}
                    {{--</a>--}}
                    {{--<ul class="dropdown-menu dropdown-messages pull-right">--}}
                        {{--<li class="dropdown-title">4 New Messages</li>--}}
                        {{--<li class="unread message">--}}
                            {{--<a href="javascript:;" class="message"> <i class="pull-right" data-toggle="tooltip"--}}
                                                                       {{--data-placement="top" title="Mark as Read"><span--}}
                                            {{--class="pull-right ol livicon" data-n="adjust" data-s="10"--}}
                                            {{--data-c="#287b0b"></span></i>--}}
                                {{--<img src="{{ asset('assets/img/authors/avatar.jpg') }}"--}}
                                     {{--class="img-responsive message-image" alt="icon">--}}

                                {{--<div class="message-body">--}}
                                    {{--<strong>Riot Zeast</strong>--}}
                                    {{--<br>Hello, You there?--}}
                                    {{--<br>--}}
                                    {{--<small>8 minutes ago</small>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="unread message">--}}
                            {{--<a href="javascript:;" class="message">--}}
                                {{--<i class="pull-right" data-toggle="tooltip" data-placement="top"--}}
                                   {{--title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10"--}}
                                                              {{--data-c="#287b0b"></span></i>--}}
                                {{--<img src="{{ asset('assets/img/authors/avatar1.jpg') }}"--}}
                                     {{--class="img-responsive message-image" alt="icon">--}}

                                {{--<div class="message-body">--}}
                                    {{--<strong>John Kerry</strong>--}}
                                    {{--<br>Can we Meet ?--}}
                                    {{--<br>--}}
                                    {{--<small>45 minutes ago</small>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="unread message">--}}
                            {{--<a href="javascript:;" class="message">--}}
                                {{--<i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">--}}
                                    {{--<span class="pull-right ol livicon" data-n="adjust" data-s="10"--}}
                                          {{--data-c="#287b0b"></span>--}}
                                {{--</i>--}}
                                {{--<img src="{{ asset('assets/img/authors/avatar5.jpg') }}"--}}
                                     {{--class="img-responsive message-image" alt="icon">--}}

                                {{--<div class="message-body">--}}
                                    {{--<strong>Jenny Kerry</strong>--}}
                                    {{--<br>Dont forgot to call...--}}
                                    {{--<br>--}}
                                    {{--<small>An hour ago</small>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="unread message">--}}
                            {{--<a href="javascript:;" class="message">--}}
                                {{--<i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">--}}
                                    {{--<span class="pull-right ol livicon" data-n="adjust" data-s="10"--}}
                                          {{--data-c="#287b0b"></span>--}}
                                {{--</i>--}}
                                {{--<img src="{{ asset('assets/img/authors/avatar4.jpg') }}"--}}
                                     {{--class="img-responsive message-image" alt="icon">--}}

                                {{--<div class="message-body">--}}
                                    {{--<strong>Ronny</strong>--}}
                                    {{--<br>Hey! sup Dude?--}}
                                    {{--<br>--}}
                                    {{--<small>3 Hours ago</small>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="footer">--}}
                            {{--<a href="#">View all</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown notifications-menu">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f"--}}
                           {{--data-hovercolor="#e9573f" data-size="28"></i>--}}
                        {{--<span class="label label-warning">7</span>--}}
                    {{--</a>--}}
                    {{--<ul class=" notifications dropdown-menu">--}}
                        {{--<li class="dropdown-title">You have 7 notifications</li>--}}
                        {{--<li>--}}
                            {{--<!-- inner menu: contains the actual data -->--}}
                            {{--<ul class="menu">--}}
                                {{--<li>--}}
                                    {{--<i class="livicon danger" data-n="timer" data-s="20" data-c="white"--}}
                                       {{--data-hc="white"></i>--}}
                                    {{--<a href="#">after a long time</a>--}}
                                    {{--<small class="pull-right">--}}
                                        {{--<span class="livicon paddingright_10" data-n="timer" data-s="10"></span>--}}
                                        {{--Just Now--}}
                                    {{--</small>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<i class="livicon success" data-n="gift" data-s="20" data-c="white"--}}
                                       {{--data-hc="white"></i>--}}
                                    {{--<a href="#">Jef's Birthday today</a>--}}
                                    {{--<small class="pull-right">--}}
                                        {{--<span class="livicon paddingright_10" data-n="timer" data-s="10"></span>--}}
                                        {{--Few seconds ago--}}
                                    {{--</small>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<i class="livicon warning" data-n="dashboard" data-s="20" data-c="white"--}}
                                       {{--data-hc="white"></i>--}}
                                    {{--<a href="#">out of space</a>--}}
                                    {{--<small class="pull-right">--}}
                                        {{--<span class="livicon paddingright_10" data-n="timer" data-s="10"></span>--}}
                                        {{--8 minutes ago--}}
                                    {{--</small>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<i class="livicon bg-aqua" data-n="hand-right" data-s="20" data-c="white"--}}
                                       {{--data-hc="white"></i>--}}
                                    {{--<a href="#">New friend request</a>--}}
                                    {{--<small class="pull-right">--}}
                                        {{--<span class="livicon paddingright_10" data-n="timer" data-s="10"></span>--}}
                                        {{--An hour ago--}}
                                    {{--</small>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<i class="livicon danger" data-n="shopping-cart-in" data-s="20" data-c="white"--}}
                                       {{--data-hc="white"></i>--}}
                                    {{--<a href="#">On sale 2 products</a>--}}
                                    {{--<small class="pull-right">--}}
                                        {{--<span class="livicon paddingright_10" data-n="timer" data-s="10"></span>--}}
                                        {{--3 Hours ago--}}
                                    {{--</small>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<i class="livicon success" data-n="image" data-s="20" data-c="white"--}}
                                       {{--data-hc="white"></i>--}}
                                    {{--<a href="#">Lee Shared your photo</a>--}}
                                    {{--<small class="pull-right">--}}
                                        {{--<span class="livicon paddingright_10" data-n="timer" data-s="10"></span>--}}
                                        {{--Yesterday--}}
                                    {{--</small>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<i class="livicon warning" data-n="thumbs-up" data-s="20" data-c="white"--}}
                                       {{--data-hc="white"></i>--}}
                                    {{--<a href="#">David liked your photo</a>--}}
                                    {{--<small class="pull-right">--}}
                                        {{--<span class="livicon paddingright_10" data-n="timer" data-s="10"></span>--}}
                                        {{--2 July 2014--}}
                                    {{--</small>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="footer">--}}
                            {{--<a href="#">View all</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Sentinel::getUser()->pic)
                            <img src="{!! url('/').'/uploads/users/'.Sentinel::getUser()->pic !!}" alt="img"
                                 class="img-circle img-responsive pull-left" height="35px" width="35px"/>
                        @else
                            <img src="{!! asset('assets/img/authors/avatar3.jpg') !!} " width="35"
                                 class="img-circle img-responsive pull-left" height="35" alt="riot">
                        @endif
                        <div class="riot">
                            <div>
                                {{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            @if(Sentinel::getUser()->pic)
                                <img src="{!! url('/').'/uploads/users/'.Sentinel::getUser()->pic !!}" alt="img"
                                     class="img-circle img-bor"/>
                            @else
                                <img src="{!! asset('assets/img/authors/avatar3.jpg') !!}"
                                     class="img-responsive img-circle" alt="User Image">
                            @endif
                            <p class="topprofiletext">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                        </li>
                        <!-- Menu Body -->
                        {{--<li>--}}
                            {{--<a href="{{ URL::route('users.show',Sentinel::getUser()->id) }}">--}}
                                {{--<i class="livicon" data-name="user" data-s="18"></i>--}}
                                {{--My Profile--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li role="presentation"></li>--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('admin.users.edit', Sentinel::getUser()->id) }}">--}}
                                {{--<i class="livicon" data-name="gears" data-s="18"></i>--}}
                                {{--Account Settings--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{--<div class="pull-left">--}}
                                {{--<a href="{{ URL::to('admin/lockscreen') }}">--}}
                                    {{--<i class="livicon" data-name="lock" data-s="18"></i>--}}
                                    {{--Lock--}}
                                {{--</a>--}}
                            {{--</div>--}}
                            <div class="pull-right">
                                <a href="{{ URL::to('admin/logout') }}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">

                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                <ul id="menu" class="page-sidebar-menu">

                    <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-dashboard fa-lg"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>                   
                    <li {!! (Request::is('admin/sold-matches') || Request::is('admin/sold-matches') || Request::is('admin/sold-matches') ? 'class="active"' : '') !!}>
                        <a href="{{ route('sold-matches') }}">
                            <i class="fa fa-gamepad fa-lg"></i>
                            <span class="title">Sold matches</span>
                        </a>
                    </li>

                    @if(Sentinel::getUser()->inRole('superadmin'))


                    <li {!! (Request::is('admin/groups') || Request::is('admin/groups/create') || Request::is('admin/groups/*') ? 'class="active"' : '') !!}>
                        <a href="#">
                            <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA"
                               data-loop="true"></i>
                            <span class="title">Groups</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li {!! (Request::is('admin/groups') ? 'class="active" id="active"' : '') !!}>
                                <a href="{{ URL::to('admin/groups') }}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Groups
                                </a>
                            </li>
                            <li {!! (Request::is('admin/groups/create') ? 'class="active" id="active"' : '') !!}>
                                <a href="{{ URL::to('admin/groups/create') }}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Add New Group
                                </a>
                            </li>
                        </ul>
                    </li>
                        @endif

                    <!-- Menus generated by CRUD generator -->
                    @include('admin/layouts/menu')



                        <li {!! (Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/users/*') || Request::is('admin/deleted_users') ? 'class="active"' : '') !!}>
                            <a href="#">
                                <i class="fa fa-user fa-lg"></i>
                                <span class="title">Users</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li {!! (Request::is('admin/users') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/users') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Users
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/users/create') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/users/create') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Add New User
                                    </a>
                                </li>
                                <li {!! (Request::is('admin/deleted_users') ? 'class="active" id="active"' : '') !!}>
                                    <a href="{{ URL::to('admin/deleted_users') }}">
                                        <i class="fa fa-angle-double-right"></i>
                                        Deleted Users
                                    </a>
                                </li>
                            </ul>
                        </li>

                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">

        <!-- Notifications -->
        @include('notifications')

                <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
   data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<!-- global js -->
<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
@if (Request::is('admin/form_builder2') || Request::is('admin/gridmanager') || Request::is('admin/portlet_draggable') || Request::is('admin/calendar'))
    <script src="{{ asset('assets/vendors/form_builder1/js/jquery.ui.min.js') }}"></script>
@endif
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!--livicons-->
<script src="{{ asset('assets/vendors/livicons/minified/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/livicons/minified/livicons-1.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/josh.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/metisMenu.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/holder-master/holder.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.loadingModal.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/lobibox.min.js')}}" type="text/javascript"></script>
<!-- end of global js -->
<!-- begin page level js -->
@if(Request::is("admin/matches/*"))
    <script type="text/javascript" language="javascript" src="{{asset('assets/js/pages/matches.js')}}"></script>
@endif
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
</script>
@yield('footer_scripts')
        <!-- end page level js -->
</body>
</html>
