<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <title>Voetbaltrips</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/voetbaltrips_frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/voetbaltrips_frontend/css/stylish-portfolio.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('assets/voetbaltrips_frontend/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('header_styles')



</head>

<body>

    <!-- Navigation -->
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="/"  onclick = $("#menu-close").click(); >Voetbaltrips</a>
            </li>
            <li>
                <a href="/" onclick = $("#menu-close").click(); >Home</a>
            </li>
            <li>
                <a href="{!! url("cart/summary") !!}">Cart Summary</a>
            </li>
            @if(Sentinel::getUser())
            <li>
                <a href="{{ url('my-orders') }}">My Orders</a>
            </li>
            @endif
        </ul>
    </nav>



    @yield('content')



    <!-- Call to Action -->
    <aside class="call-to-action bg-primary">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <hgroup>
                        <h2>
Meld je aan voor onze nieuwsbrief
                        </h2>
                    </hgroup>
                    <div class="text-center">
                        <form action="#">
                            <div class="input-group center-block">
                                <input class="btn btn-lg" name="email" id="email" type="email" placeholder="Jouw email" required>
                                <button class="btn btn-info btn-lg" type="submit">Aanmelden</button>
                            </div>
                        </form>
                    </div>
                    <small class="promise"><em>Wij gaan vertrouwelijk met uw gegevens om</em></small>
                </div>
            </div>
        </div>
    </aside>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Voetbaltrips B.V.</strong>
                    </h4>

                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (078) 5472942</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:name@example.com">support@voetbaltrips.nl</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Voetbaltrips 2016</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('assets/voetbaltrips_frontend/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/voetbaltrips_frontend/js/bootstrap.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script>
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
    </script>
    @if(Request::is("match/*") or Request::is("cart/*"))
        <script src="{{ asset('assets/voetbaltrips_frontend/js/match.js') }}"></script>
    @endif
    @yield('footer_scripts')
</body>

</html>
