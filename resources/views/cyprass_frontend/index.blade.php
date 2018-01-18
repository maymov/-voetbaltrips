 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <!-- Basic Page Needs
    ================================================== -->
        <meta charset="utf-8">
        <title>Voetbaltrips</title>
        <meta name="description" content="">
        <!-- Mobile Specific Metas
    ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
         <!-- CSS
         ================================================== -->
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/bootstrap.min.css') }}"/>
        <!-- FontAwesome -->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/font-awesome.min.css') }}"/>
        <!-- Animation -->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/animate.css') }}" />
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/owl.carousel.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/owl.theme.css') }}"/>
        <!-- Pretty Photo -->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/prettyPhoto.css') }}"/>
        <!-- Main color style -->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/red.css') }}"/>
        <!-- Template styles-->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/custom.css') }}" />
        <!-- Responsive -->
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/responsive.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/cyprass_frontend/css/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
	
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500' rel='stylesheet' type='text/css'>
    </head>

 <body data-spy="scroll" data-target=".navbar-fixed-top">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <header id="section_header" class="navbar-fixed-top main-nav" role="banner">
    	<div class="container">
    		<!-- <div class="row"> -->
                 <div class="navbar-header ">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            {{--<img src="{{ asset('assets/cyprass_frontend/images/logo2.png') }}" alt="">--}}
                            Voetbaltrips
                        </a>
                 </div><!--Navbar header End-->
                 	<nav class="collapse navbar-collapse navigation" id="bs-example-navbar-collapse-1" role="navigation">
                        <ul class="nav navbar-nav navbar-right ">
                           	<li class="active"> <a href="#slider_part" class="page-scroll">Home </a></li>
                            <li><a href="#service"  class="page-scroll">Services</a> </li>
                            <li><a href="#contact" class="page-scroll">Contact Us</a> </li>
                        </ul>
                     </nav>
                </div><!-- /.container-fluid -->
</header>
 <!-- Slider start -->
    <section id="slider_part">
         <div class="carousel slide" id="carousel-example-generic" data-ride="carousel">
            <!-- Indicators -->
         	 <ol class="carousel-indicators text-center">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
             </ol>

           	<div class="carousel-inner">
           	 	<div class="item active">
           	 		<div class="overlay-slide">
           	 			<img src="{{ asset('assets/cyprass_frontend/images/banner/p5.jpg') }}" alt="" class="img-responsive">
           	 		</div>
           	 		<div class="carousel-caption">
               	 		<div class="col-md-12 col-xs-12 text-center">
                      <h2>Voetbaltrips</h2>
               	 			<h3 class="animated2"> <b>Beautiful</b> Easy And Effective  </h3>
               	 			<div class="line"></div>
               	 			<p class="animated3">The only tool you need</p>
               	 		</div>
           	 		</div>
           	 	</div>
                <div class="item">
                    <div class="overlay-slide">
                        <img src="{{ asset('assets/cyprass_frontend/images/banner/p5.jpg') }}" alt="" class="img-responsive">
           	 		</div>
           	 		<div class="carousel-caption">
               	 		<div class="col-md-12 col-xs-12 text-center">
                    <h2>Voetbaltrips</h2>
               	 			<h3 class="animated3"> Get the <b>Advantage </b></h3>
               	 			<div class="line"></div>
               	 			<p class="animated2">Wow your prospects</p>
               	 		</div>
           	 		</div>
           	 	</div>
           	 	<div class="item">
                    <div class="overlay-slide">
                        <img src="{{ asset('assets/cyprass_frontend/images/banner/p5.jpg') }}" alt="" class="img-responsive">
           	 		</div>
           	 		<div class="carousel-caption">
               	 		<div class="col-md-12 col-xs-12 text-center">
                    <h2>Voetbaltrips</h2>
               	 			<h3 class="animated3"> We <b>Build</b></h3>
               	 			<div class="line"></div>
               	 			<p class="animated2">Voetbaltrips</p>
               	 		</div>
           	 		</div>
           	 	</div>

           	 </div> 	 <!-- End Carousel Inner -->

            <!-- Controls -->
            <div class="slides-control ">
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                	<span><i class="fa fa-angle-left"></i></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                	<span><i class="fa fa-angle-right"></i></span>
                </a>
            </div>
        </div>
  	</section>
    <!--/ Slider end -->

<!-- Service Area start -->

    <section id="service">
        <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="feature_header text-center">
                            <h3 class="feature_title">Our <b>Services</b></h3>
                            <h4 class="feature_sub">We provide you with a tool to inform and wow your prospects <br> Beautifully designed voetbaltrips with all the information they need to make their decision.</h4>
                            <div class="divider"></div>
                        </div>
                    </div>  <!-- Col-md-12 End -->
                </div>
                <div class="row">
                    <div class="main_feature text-center">
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-lightbulb-o"></i>
                                    <h5>Lightweight</h5>
                                    <p>You can not ignore mobile devices anymore and with this theme all your visitors will be very pleased how they see your website.</p>
                                    <button class="btn btn-main"> Read More</button>
                                </div>
                            </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-pencil"></i>
                                    <h5>Beautiful Typrography</h5>
                                    <p>This theme integrates with WordPress in the most awesome way! Functionality is separated from style through uncreadble useful for user. </p>
                                    <button class="btn btn-main"> Read More</button>
                                </div>
                        </div> <!-- Col-md-4 Single_feature End -->
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-cog"></i>
                                    <h5>Full time Support</h5>
                                    <p>Full Time support. Very much helpful and possesive at the same time. With all this in mind you won’t be outdated anytime soon. Really!! </p>
                                    <button class="btn btn-main"> Read More</button>
                                </div>
                        </div> <!-- Col-md-4 Single_feature End -->
                        <div class="col-md-3 col-xs-12 col-sm-6">
                                <div class="feature_content">
                                    <i class="fa fa-desktop"></i>
                                    <h5>Ultra Responsive</h5>
                                    <p>Shadow is as optimized as it gets. No useless wrappers, no double headings, everything is coded with SEO in mind. Content is KING! </p>
                                    <button class="btn btn-main"> Read More</button>
                                </div>
                        </div> <!-- Col-md-4 Single_feature End -->
                        <!-- <button class="btn btn-main"> Read More</button> -->
                    </div>
            </div>  <!-- Row End -->
        </div>  <!-- Container End -->
    </section>
<!-- Service Area End -->

<div class="clearfix"></div>


<!-- Counter Strat -->

<section id="counter_area">
        <div class="facts">
            <div class="container">
                <div class="col-md-3 col-xs-12 col-sm-6 columns">
                    <div class="facts-wrap">
                     <div class="graph">
                        <div class="graph-left-side">
                        	<div class="graph-left-container">
                        		<div class="graph-left-half"> </div>
                        	</div>
                        </div>
                        <div class="graph-right-side">
                        	<div class="graph-right-container">
                        		<div class="graph-right-half"></div>
                        	</div>
                        </div>
                        <i class="fa fa-thumbs-o-up fa-3x fw"></i>
                        <div class="facts-wrap-num">
                            <span class="counter">87</span>
                        </div>
                    </div>
                        <h6>Clients</h6>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6 columns">
                    <div class="facts-wrap">
                     <div class="graph">
                        <div class="graph-left-side">
                        	<div class="graph-left-container">
                        		<div class="graph-left-half"> </div>
                        	</div>
                        </div>
                        <div class="graph-right-side">
                        	<div class="graph-right-container">
                        		<div class="graph-right-half"></div>
                        	</div>
                        </div>
                        <i class="fa fa-gift fa-3x fw"></i>
                        <div class="facts-wrap-num"><span class="counter">287</span></div>
                     </div>
                        <h6>voetbaltrips</h6>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6 columns">
                    <div class="facts-wrap">
                     <div class="graph">
                        <div class="graph-left-side">
                        	<div class="graph-left-container">
                        		<div class="graph-left-half"> </div>
                        	</div>
                        </div>
                        <div class="graph-right-side">
                        	<div class="graph-right-container">
                        		<div class="graph-right-half"></div>
                        	</div>
                        </div>
                        <i class="fa fa-check-square-o fa-3x fw"></i>
                        <div class="facts-wrap-num"><span class="counter">235</span></div>
                        </div>
                        <h6>Accepted voetbaltrips</h6>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6 columns">
                    <div class="facts-wrap">
                     <div class="graph">
                        <div class="graph-left-side">
                        	<div class="graph-left-container">
                        		<div class="graph-left-half"> </div>
                        	</div>
                        </div>
                        <div class="graph-right-side">
                        	<div class="graph-right-container">
                        		<div class="graph-right-half"></div>
                        	</div>
                        </div>
                        <i class="fa fa-envelope-o fa-3x fw"></i>
                        <div class="facts-wrap-num"><span class="counter">164</span></div>
                        </div>
                        <h6>Invoices</h6>
                    </div>
                </div>
            </div> <!-- Conatainer End -->
        </div>	<!-- Fact div ENd -->
</section>
<!-- Counter End -->

<!-- Counter End -->
<div class="clearfix"></div>
<section id="video-fact">
    <div class="container">
         <div class="row">
                 <div class="col-md-6 ">
                    <div class="landing-video">
                        <div class="video-embed wow fadeIn" data-wow-duration="1s">
                                <!-- Change the url -->
                            <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/6v2L2UGZJAM?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="video-text">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                            <div class="panel-heading active" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  Heading One
                                </a>
                              </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                              <div class="panel-body p1">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                              </div>
                            </div>
                          </div>
                      <div class="panel panel-default">
                        <div class="panel-heading " role="tab" id="headingTwo">
                          <h4 class="panel-title">
                            <a class="accordion-toggle collapsed"  data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Heading Two
                            </a>
                          </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body p1">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. 
                          </div>
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-heading " role="tab" id="headingThree">
                          <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Heading Three
                            </a>
                          </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body p1">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div> 
        </div><!-- row End -->
    </div>
</section>

<div class="clearfix"></div>

<!-- Pricing Table Start -->
<section id="pricing_table" class="pricing_overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title">Our <b>Pricing</b></h3>
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
            </div>  <!-- Col-md-12 End -->

            <div class="text-center pricing">
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <div class="single_table">
                    <div class="plan_wraper"></div>
                        <ul>
                            <li class="plan">Standard <br><span>Monthly plan</span></li>
                            <li class="price"> 29 <span>$</span></li>
                            <li> 20 gb disk Space</li>
                            <li>Monthly Bandwidth</li>
                            <li>Unlimited Users</li>
                            <li> 150 Domains</li>
                            <li> 150 Email Account</li>
                            <li> Automated Cloud Backup</li>
                            <li class="price_button"> <button class="btn btn-main">Sign UP Now!</button></li>
                        </ul>
                    </div>
                </div> <!-- Single col-md-4 End -->
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <div class="single_table grey_bg  ">
                        <div class="plan_wraper"></div>
                        <ul>
                            <li class="plan">Unlimited  <br><span>Monthly plan</span></li>
                            <li class="price"> 29 <span>$</span></li>
                            <li> 20 gb disk Space</li>
                            <li>Monthly Bandwidth</li>
                            <li>Unlimited Users</li>
                            <li> 150 Domains</li>
                            <li> 150 Email Account</li>
                            <li> Automated Cloud Backup</li>
                            <li class="price_button"> <button class="btn btn-main featured">Sign UP Now!</button></li>
                        </ul>
                    </div>
                </div> <!-- Single col-md-4 End -->
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <div class="single_table dark_bg">
                        <div class="plan_wraper"></div>
                        <ul>
                            <li class="plan">Premium  <br><span>Monthly plan</span></li>
                            <li class="price"> 29 <span>$</span></li>
                            <li> 20 gb disk Space</li>
                            <li>Monthly Bandwidth</li>
                            <li>Unlimited Users</li>
                            <li> 150 Domains</li>
                            <li> 150 Email Account</li>
                            <li> Automated Cloud Backup</li>
                            <li class="price_button"> <button class="btn btn-main">Sign UP Now!</button></li>
                        </ul>
                    </div>
                </div> <!-- Single col-md-4 End -->
            </div>
        </div>
    </div>
</section>  <!-- Pricing Section End -->
<!-- Pricing Table End -->


<!-- Testimonial Area End -->

<!-- Conatct Area Start-->

<section id="contact">
    <div class="container">
        <div class="row">
  			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="feature_header text-center">
                    <h3 class="feature_title">Keep In <b>touch</b></h3>
                    <h4 class="feature_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                    <div class="divider"></div>
                </div>
  			</div>
        </div>
        <div class="row">
             <div class="contact_full">
                <div class="col-md-6 left">
                    <div class="left_contact">
                        <form action="role">
                            <div class="form-level">
                                <input name="name" placeholder="Name" id="name"  value="" type="text" class="input-block">
                                <span class="form-icon fa fa-user"></span>
                            </div>
                            <div class="form-level">
                                <input name="email" placeholder="Email" id="mail" class="input-block" value="" type="email">
                                <span class="form-icon fa fa-envelope-o"></span>
                            </div>
                            <div class="form-level">
                                <input name="name" placeholder="Phone" id="phone" class="input-block" value="" type="text">
                                <span class="form-icon fa fa-phone"></span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6 right">
                    <div class="form-level">
                        <textarea name="" id="messege"  rows="5" class="textarea-block" placeholder="message"></textarea>
                        <span class="form-icon fa fa-pencil"></span>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button class="btn btn-main featured">Submit Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="g-map" class="no-padding">
	<div class="container-fluid">
		<div class="row">
			<div class="map" id="map"></div>
		</div>
	</div>
</div>
<!-- Footer Area Start -->

<section id="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h3 class="menu_head">Main Menu</h3>
                    <div class="footer_menu">
                        <ul>
                            <li><a href="#about">Home</a></li>
                            <li><a href="#service">Service</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h3 class="menu_head">Useful Links</h3>
                    <div class="footer_menu">
                        <ul>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#"> inventore natus ullam eum</a></li>
                            <li><a href="#">consectetur adipisicing elit.</a></li>
                            <li><a href="#">Frequently Asked Questions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <h3 class="menu_head">Contact us</h3>
                    <div class="footer_menu_contact">
                        <ul>
                            <li> <i class="fa fa-home"></i>
                                <span> Dordrecht </span></li>
                            <li><i class="fa fa-globe"></i>
                                <span> +31-85231237</span></li>
                            <li><i class="fa fa-phone"></i>
                                <span> info@voetbaltrips.nl</span></li>
                            <li><i class="fa fa-map-marker"></i>
                            <span> www.voetbaltrips.nl</span></li>
                        </ul>
                    </div>
                </div>

                {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
                    {{--<h3 class="menu_head">Tags</h3>--}}
                    {{--<div class="footer_menu tags">--}}
                        {{--<a href="#"> Design</a>--}}
                        {{--<a href="#"> User Interface</a>--}}
                        {{--<a href="#"> Graphics</a>--}}
                        {{--<a href="#"> Web Design</a>--}}
                        {{--<a href="#"> Development</a>--}}
                        {{--<a href="#"> Asp.net</a>--}}
                        {{--<a href="#"> Bootstrap</a>--}}
                        {{--<a href="#"> Joomla</a>--}}
                        {{--<a href="#"> SEO</a>--}}
                        {{--<a href="#"> Wordepress</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
        </div>
    </div>

    <div class="footer_b">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer_bottom">
                        <p class="text-block"> &copy; Copyright reserved to <span>voetbaltrips.css </span></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer_mid pull-right">
                        <ul class="social-contact list-inline">
                            <li> <a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li> <a href="#"><i class="fa fa-rss"></i></a></li>
                            <li> <a href="#"><i class="fa fa-google-plus"></i> </a></li>
                            <li><a href="#"> <i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"> <i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Footer Area End -->

<!-- Back To Top Button -->
    <div id="back-top">
        <a href="#slider_part" class="scroll" data-scroll>
            <button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-up"></i></button>
        </a>
    </div>
    <!-- End Back To Top Button -->

<!-- Javascript Files
    ================================================== -->
    <!-- initialize jQuery Library -->

		<!-- initialize jQuery Library -->
        <!-- Main jquery -->
		    <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/jquery.js') }}"></script>
        <!-- Bootstrap jQuery -->
         <script src="{{ asset('assets/cyprass_frontend/js/bootstrap.min.js') }}"></script>
        <!-- Owl Carousel -->
        <script src="{{ asset('assets/cyprass_frontend/js/owl.carousel.min.js') }}"></script>
        <!-- Isotope -->
        <script src="{{ asset('assets/cyprass_frontend/js/jquery.isotope.js') }}') }}"></script>
        <!-- Pretty Photo -->
		    <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/jquery.prettyPhoto.js') }}"></script>
        <!-- SmoothScroll -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/smooth-scroll.js') }}"></script>
        <!-- Image Fancybox -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
        <!-- Counter  -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/jquery.counterup.min.js') }}"></script>
        <!-- waypoints -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/waypoints.min.js') }}"></script>
        <!-- Bx slider -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/jquery.bxslider.min.js') }}"></script>
        <!-- Scroll to top -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/jquery.scrollTo.js') }}"></script>
        <!-- Easing js -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/jquery.easing.1.3.js') }}"></script>
   		 <!-- PrettyPhoto -->
        <script src="{{ asset('assets/cyprass_frontend/js/jquery.singlePageNav.js') }}"></script>
      	<!-- Wow Animation -->
        <script type="js/javascript" src="{{ asset('assets/cyprass_frontend/js/wow.min.js') }}"></script>
        <!-- Google Map  Source -->
        <script type="text/javascript" src="{{ asset('assets/cyprass_frontend/js/gmaps.js') }}"></script>
			 <!-- Custom js -->
        <script src="{{ asset('assets/cyprass_frontend/js/custom.js') }}"></script>
	     <script>
		// Google Map - with support of gmaps.js
     var map;
        map = new GMaps({
          div: '#map',
          lat: 51.80914,
          lng: 4.66682,
          scrollwheel: false,
          panControl: false,
          zoomControl: false,
        });

        map.addMarker({
          lat: 23.709921,
          lng: 90.407143,
          title: 'Smilebuddy',
          infoWindow: { 
            content: '<p> Smilebuddy, Dhanmondhi 27</p>'
          },
          icon: "{{ asset('assets/cyprass_frontend/images/map1.png') }}"
        });
      	</script>
 
    </body>
</html>
