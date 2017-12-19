<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('check-mail-bcc/{to}/{bcc}', function ($to, $bcc) {
    \Mail::raw('test message', function ($message) use ($to, $bcc) {
        $message->to($to)->subject('title bcc');
        $message->bcc($bcc, 'title bcc');
    });
});

Route::get('layout', function () {
    return View::make('newtemplate/layout');
});

Route::get('viewinvoiceraw/{invoiceId}', function () {
    return View::make('pdf/invoice2');
});

Route::get('viewinvoice/{invoiceId}',array('as' => 'viewinvoice','uses' => 'DemoInvoiceController@index'));

Route::get('teeest', function(){
	return view('admin.mails.blades.total');
});

Route::get('mollietest', ['uses'=>'PurchaseController@index','as'=>'purchase.index']);
Route::get('paymenturl', ['uses'=>'PurchaseController@create','as'=>'purchase.create']);
Route::post('paymenturl', ['uses'=>'PurchaseController@store','as'=>'purchase.store']);
Route::get('checkout', ['uses'=>'PurchaseController@show','as'=>'purchase.show']);

/**
 * Model binding into route
 */
Route::model('blogcategory', 'App\BlogCategory');
Route::model('blog', 'App\Blog');
Route::model('file', 'App\File');
Route::model('task', 'App\Task');
Route::model('users', 'App\User');

Route::pattern('slug', '[a-z0-9- _]+');

Route::group(array('prefix' => 'admin'), function () {

	# Error pages should be shown without requiring login
	Route::get('404', function () {
		return View('admin/404');
	});
	Route::get('500', function () {
		return View::make('admin/500');
	});

	# Lock screen
	Route::get('lockscreen', function () {
		return View::make('admin/lockscreen');
	});

	# All basic routes defined here
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');
	Route::post('signup', array('as' => 'signup', 'uses' => 'AuthController@postSignup'));
	Route::post('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@postForgotPassword'));
	Route::get('login2', function () {
		return View::make('admin/login2');
	});

	# Register2
	Route::get('register2', function () {
		return View::make('admin/register2');
	});
	Route::post('register2', array('as' => 'register2', 'uses' => 'AuthController@postRegister2'));

	# Forgot Password Confirmation
	Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

	# Account Activation
	Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
});

Route::group(array('prefix' => 'admin', 'middleware' => 'SentinelAdmin'), function () {
    # Dashboard / Index
	Route::get('/', array('as' => 'dashboard','uses' => 'JoshController@showHome'));
    Route::get('/sold-matches', array('as' => 'sold-matches','uses' => 'JoshController@soldMatches'));
    Route::get('/sold-match/{matchId}', array('as' => 'sold-match','uses' => 'JoshController@soldMatch'));

    # Discount
    Route::resource('discount', 'DiscountController', ['except' => ['show']]);

    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'UsersController@index'));
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');
        Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'UsersController@destroy'));
        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'UsersController@getModalDelete'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
        Route::get('{userId}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
        Route::post('passwordreset', 'UsersController@passwordreset');
    });
    Route::resource('users', 'UsersController');

	Route::get('deleted_users',array('as' => 'deleted_users','before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'));

	# Group Management
    Route::group(array('prefix' => 'groups'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@index'));
        Route::get('create', array('as' => 'create/group', 'uses' => 'GroupsController@create'));
        Route::post('create', 'GroupsController@store');
        Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'GroupsController@edit'));
        Route::post('{groupId}/edit', 'GroupsController@update');
        Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'GroupsController@destroy'));
        Route::get('{groupId}/confirm-delete', array('as' => 'confirm-delete/group', 'uses' => 'GroupsController@getModalDelete'));
        Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'GroupsController@getRestore'));
    });
    /*routes for blog*/
	Route::group(array('prefix' => 'blog'), function () {
        Route::get('/', array('as' => 'blogs', 'uses' => 'BlogController@index'));
        Route::get('create', array('as' => 'create/blog', 'uses' => 'BlogController@create'));
        Route::post('create', 'BlogController@store');
        Route::get('{blog}/edit', array('as' => 'update/blog', 'uses' => 'BlogController@edit'));
        Route::post('{blog}/edit', 'BlogController@update');
        Route::get('{blog}/delete', array('as' => 'delete/blog', 'uses' => 'BlogController@destroy'));
		Route::get('{blog}/confirm-delete', array('as' => 'confirm-delete/blog', 'uses' => 'BlogController@getModalDelete'));
		Route::get('{blog}/restore', array('as' => 'restore/blog', 'uses' => 'BlogController@getRestore'));
        Route::get('{blog}/show', array('as' => 'blog/show', 'uses' => 'BlogController@show'));
        Route::post('{blog}/storecomment', array('as' => 'restore/blog', 'uses' => 'BlogController@storecomment'));
	});

    /*routes for blog category*/
	Route::group(array('prefix' => 'blogcategory'), function () {
        Route::get('/', array('as' => 'blogcategories', 'uses' => 'BlogCategoryController@index'));
        Route::get('create', array('as' => 'create/blogcategory', 'uses' => 'BlogCategoryController@create'));
        Route::post('create', 'BlogCategoryController@store');
        Route::get('{blogcategory}/edit', array('as' => 'update/blogcategory', 'uses' => 'BlogCategoryController@edit'));
        Route::post('{blogcategory}/edit', 'BlogCategoryController@update');
        Route::get('{blogcategory}/delete', array('as' => 'delete/blogcategory', 'uses' => 'BlogCategoryController@destroy'));
		Route::get('{blogcategory}/confirm-delete', array('as' => 'confirm-delete/blogcategory', 'uses' => 'BlogCategoryController@getModalDelete'));
		Route::get('{blogcategory}/restore', array('as' => 'restore/blogcategory', 'uses' => 'BlogCategoryController@getRestore'));
	});

	/*routes for file*/
	Route::group(array('prefix' => 'file'), function () {
        Route::post('create', 'FileController@store');
		Route::post('createmulti', 'FileController@postFilesCreate');
		Route::delete('delete', 'FileController@delete');
	});

	Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    Route::post('crop_demo','JoshController@crop_demo');

	/* laravel example routes */
	# datatables
	Route::get('datatables', 'DataTablesController@index');
	Route::get('datatables/data', array('as' => 'admin.datatables.data', 'uses' => 'DataTablesController@data'));

    //tasks section
    Route::post('task/create', 'TaskController@store');
    Route::get('task/data', 'TaskController@data');
    Route::get('task/{id}', 'TaskController@show');
    Route::get('tasks', 'TaskController@index');
    Route::post('task/{task}/edit', 'TaskController@update');
    Route::post('task/{task}/delete', 'TaskController@delete');


    Route::get('calendar',  array('as' => 'calendar','uses' => 'JoshController@calendar'));

    /**
     * Uploading the flight csv data
     */
    Route::post("flights/importflightcsv", 'FlightsController@importFlightCsv');
	# Remaining pages will be called from below controller method
	# in real world scenario, you may be required to define all routes manually
    Route::post("countries/importcsv", "CountriesController@importcsv");
	Route::get('{name?}', 'JoshController@showView');

});

#FrontEndController
Route::get('login', array('as' => 'login','uses' => 'FrontEndController@getLogin'));
Route::post('login','FrontEndController@postLogin');
Route::get('register', array('as' => 'register','uses' => 'FrontEndController@getRegister'));
Route::post('register','FrontEndController@postRegister');
Route::get('activate/{userId}/{activationCode}',array('as' =>'activate','uses'=>'FrontEndController@getActivate'));
Route::get('forgot-password',array('as' => 'forgot-password','uses' => 'FrontEndController@getForgotPassword'));
Route::post('forgot-password','FrontEndController@postForgotPassword');
# Forgot Password Confirmation
Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'FrontEndController@getForgotPasswordConfirm'));
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
# My account display and update details
Route::group(array('middleware' => 'SentinelUser'), function () {
	Route::get('my-account', array('as' => 'my-account', 'uses' => 'FrontEndController@myAccount'));
    Route::put('my-account', 'FrontEndController@update');
});
Route::get('logout', array('as' => 'logout','uses' => 'FrontEndController@getLogout'));
# contact form
Route::post('contact',array('as' => 'contact','uses' => 'FrontEndController@postContact'));

#frontend views
//Route::get('/', array('as' => 'home', function () {
//    return View::make('voetbaltrips_frontend.index');
//}));

Route::get('/', array('as' => 'home', 'uses' => 'VoetbaltripsFrontendController@getIndex'));
Route::get('/match/{match_id}', array('as' => 'match', 'uses' => 'VoetbaltripsFrontendController@getMatch'));
Route::post('/ajax/clubs/', array('as' => 'ajax.clubs', 'uses' => 'VoetbaltripsFrontendController@getAjaxClubs'));
Route::post('/ajax/clubsForDD', array('as' => 'ajax.clubsForDD', 'uses' => 'VoetbaltripsFrontendController@getAjaxClubsForDD'));
Route::post('/ajax/citiesForDD', array('as' => 'ajax.citiesForDD', 'uses' => 'VoetbaltripsFrontendController@getAjaxCitiesForDD'));
Route::post('/ajax/tournamentsForDD', array('as' => 'ajax.tournamentsForDD', 'uses' => 'VoetbaltripsFrontendController@getAjaxTournamentsForDD'));
Route::post('/ajax/dropdowns', array('as' => 'ajax.tournaments', 'uses' => 'VoetbaltripsFrontendController@dropdowns'));

Route::get('/tickets' , array('as' => 'ticket_home', 'uses' => 'TicketOnlySaleController@getIndexTickets'));
Route::get('/tickets/{match_id}', array('as' => 'ticketbuy', 'uses' => 'TicketOnlySaleController@getMatch'));
Route::post("/ticketsave/{match_id}", array("as" => "ticketsave", "uses" => "TicketOnlySaleController@addTicketToCart"));
Route::get("/tickets/travellerinfo/{match_id}", array("as" => "ticketstravellerinfo", "uses" => "TicketOnlySaleController@travellerInfo"));
Route::post("/tickets/{match_id}/savetravellerinfo", ["uses" => "VoetbaltripsFrontendController@saveTravellerInformation"]);

Route::get("/cart/summary", array("as" => "showcartsummary", "uses" => "VoetbaltripsFrontendController@cartSummary"));
Route::get("/coupon_check_code", array("as" => "coupon_check_code", "uses" => "VoetbaltripsFrontendController@couponCheckCode"));
Route::post("/ajax/addtickethome", array("as" => "addtickethome", "uses" => "VoetbaltripsFrontendController@sentTicketsHome"));

Route::get('blog', array('as' => 'blog', 'uses' => 'BlogController@getIndexFrontend'));
Route::get('blog/{slug}/tag', 'BlogController@getBlogTagFrontend');
Route::get('blogitem/{slug?}', 'BlogController@getBlogFrontend');
Route::post('blogitem/{blog}/comment', 'BlogController@storeCommentFrontend');

//Route::get('{name?}', 'JoshController@showFrontEndView');
Route::post('/ajax/matches', 'VoetbaltripsFrontendController@getAjaxMatches');

Route::post('/ajax/tickets', 'TicketOnlySaleController@getAjaxTickets');

Route::post('ajax/language', 'LanguagesController@changeLang');
Route::post('ajax/modal', 'LanguagesController@sentForModal');

Route::post('/ajax/loadcities', 'VoetbaltripsFrontendController@getAjaxCities');
Route::get("/images/{category}/{filename}", "VoetbaltripsFrontendController@getImagesFromStorage");
Route::post("/matchsave/{match_id}", array("as" => "matchsave", "uses" => "VoetbaltripsFrontendController@addMatchToCart"));
Route::get("/match/{match_id}/flight", array("as"=>"flightselection", "uses" => "VoetbaltripsFrontendController@flightSelection"));
Route::get("/match/{match_id}/accomodation", array("as" =>"roomselection", "uses" => "VoetbaltripsFrontendController@showRoomForMatch"));
Route::post("/roomsave/{match_id}", array("as" => "roomsaveformatch", "uses" => "VoetbaltripsFrontendController@bookRoomForMatch"));
Route::get("/cart/summary", array("as" => "showcartsummary", "uses" => "VoetbaltripsFrontendController@cartSummary"));
Route::post("/flightsave/{match_id}", array("as" => "flightsave", "uses" => "VoetbaltripsFrontendController@bookFlightForMatch"));
Route::get("/match/{match_id}/flight/edit", array("as" => "editflight", "uses"=>"VoetbaltripsFrontendController@editFlightTicket"));
Route::get("/match/{match_id}/accomodation/edit", array("as" => "editaccomodation", "uses"=>"VoetbaltripsFrontendController@editAccomodation"));
Route::post("/match/{match_id}/flight/{cart_id}", array("as" => "updateflight", "uses"=>"VoetbaltripsFrontendController@updateFlightCart"));
Route::post("/match/{match_id}/accomodation/{cart_id}", array("as" => "updateaccomodation", "uses"=>"VoetbaltripsFrontendController@updateAccomodationCart"));
Route::get("/ajax/resetcart", array("as" => "resetcart", "uses" => "VoetbaltripsFrontendController@resetCart"));
Route::get("/cart/proceed","VoetbaltripsFrontendController@checkProceedtoPayment");
Route::group(["middleware" => "SentinelUser"], function(){
    Route::get("/cart/payment", "CartController@paymentSelection");
    Route::get("/cart/confirmorder", "CartController@paymentConfirm");
    Route::get("/payment/{order}", array('as' => 'payment', 'uses' => 'CartController@paymentCheck'));
    Route::get("/my-orders", "UserOrderController@index");
    Route::get("/listorders", "UserOrderController@getOrders");
    Route::get("/my-orders/view/{order_id}", "UserOrderController@viewOrder");
    Route::post("/my-orders/{order_id}/saveadditionaldata", "UserOrderController@saveAdditionalData");
    Route::post("/order/updatetravellerinfo", ["uses" => "UserOrderController@updateTravellerInformation"]);
    Route::post("/order/gettravellerinfo", ["uses"=>"UserOrderController@getTravellerInformation"]);
});
/*Route::get("clearclub", function(){
    \App\Club::truncate();
});*/
/*Route::get("clearmatch", function(){
    \App\Match::truncate();
});*/
Route::get("travellerinfo/{match_id}", ["uses"=>"VoetbaltripsFrontendController@travellerinfo"]);
Route::post("/match/{match_id}/savetravellerinfo", ["uses" => "VoetbaltripsFrontendController@saveTravellerInformation"]);
Route::get("travellerinfo/{match_id}/edit", ["uses"=>"VoetbaltripsFrontendController@editTravellerinfo"]);
Route::post("mycart-popup", ["uses"=>"VoetbaltripsFrontendController@showCartPopup"]);
Route::post("filterairport", ["uses" => "VoetbaltripsFrontendController@filterairport"]);
Route::get("match/{match_id}/extras", ["uses" => "VoetbaltripsFrontendController@showExtras"]);
Route::post("addoptions", ["uses" => "VoetbaltripsFrontendController@addOptionsToCart"]);
Route::post("removeoptions", ["uses" => "VoetbaltripsFrontendController@removeOptionsFromCart"]);
Route::get("match/{match_id}/extras/addmore", ["uses" => "VoetbaltripsFrontendController@showExtras"]);
Route::get("download/{type}/{filename}", ["uses"=>"VoetbaltripsFrontendController@downloadFiles"]);
Route::post("gethoteldetails", ["uses"=>"VoetbaltripsFrontendController@getHotelDetails"]);
Route::get("getcartprice", ["uses"=>"VoetbaltripsFrontendController@getCartTotalPrice"]);
Route::post("searchflights", ["uses"=>"VoetbaltripsFrontendController@searchFlights"]);
Route::post("addpackage/{match_id}", ["uses"=>"VoetbaltripsFrontendController@addPackageToCart"]);
Route::get("cart/confirm", ["uses" => "VoetbaltripsFrontendController@checkEverythingBeforeConfirmCart"]);
Route::get("cart/confirm", ["uses" => "VoetbaltripsFrontendController@checkEverythingBeforeConfirmCart"]);

Route::post("addticket/{match_id}", ["uses"=>"TicketOnlySaleController@buyTicket"]);

# End of frontend views

