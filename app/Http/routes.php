<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Constants
|--------------------------------------------------------------------------
|
| All the constants. 
|
*/

include('constants.inc');



/*
|--------------------------------------------------------------------------
| New in Laravel 5.2, use of 'web' middleware for the routes where
| Session, Cookies, tokens, etc are needed.
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => ['web', 'auth']], function () {

    /*
    |--------------------------------------------------------------------------
    | Example use of Middleware
    |--------------------------------------------------------------------------
    |
    | 'auth' middleware is used to make sure only
    | authenticated users can access these routes.
    |
    */
//    Route::get('account/'                       , ['middleware' => 'auth', 'uses' => 'Account\AccountController@index']);
    Route::get('account/'                       , 'Account\AccountController@index');
    Route::get('account/change-password/'       , 'Auth\PasswordController@getChangePassword');
//    Route::get('account/edit-profile/'          , 'UserController@getEditProfile');
    Route::get('account/orders/'                , 'Order\OrderController@getAll');
    Route::get('account/orders/details/'        , 'Order\OrderController@getOne');
    Route::get('account/eticket/'               , 'Order\EticketController@getEticket');
    Route::get('checkout/details'               , 'Order\CheckoutController@address_form');
    Route::get('checkout/payment'               , 'Order\CheckoutController@paymentForm');
    Route::post('checkout/details-proccess'     , 'Order\CheckoutController@address_form_proccess');      
    Route::post('checkout/payment-process'      , 'Order\ProcessPaymentController@processPaymentForm');
    Route::get('checkout/order-complete'        , 'Order\OrderController@loadOrderComplete');
    Route::post('account/save-plate'            , 'Account\AccountController@savePlate');
    Route::post('account/request-refund'        , 'Account\AccountController@requestRefund');
    
});


Route::group(['middleware' => ['web', 'auth', 'admin']], function () {

    /*
    |--------------------------------------------------------------------------
    | Routes for admin users
    |--------------------------------------------------------------------------
    |
    |
    */
    
    

    Route::get('admin/', function () { return view('admin.dashboard'); });
    
    // season tickets
    Route::get('admin/multi-tickets/'                  , 'MultiTicketsController@listAll');
      
    Route::get('admin/multi-tickets/carparks/'         , 'MultiTicketsController@listAllCarParks');
    Route::post('admin/multi-tickets/car-park/'        , 'MultiTicketsController@addAmendCarPark');
    
    // Season Ticket: Create / Edit
    Route::get('admin/multi-tickets/create-edit/'      , 'MultiTicketsController@createEditForm');
    Route::post('admin/multi-tickets/create-edit/'     , 'MultiTicketsController@createEditEvent');    

    // events
    Route::get('admin/events/',     'EventsController@listAll');
    Route::post('admin/events/',    'EventsController@listAll');

    Route::get('admin/events/event/'               , 'EventsController@index');       
    Route::get('admin/events/event-carparks/'      , 'EventsController@loadAllCarparksForAnEvent');
    Route::get('admin/events/event-multi-tickets/' , 'EventsController@loadAllMultiTicketsForAnEvent'); 
    Route::post('admin/events/car-park/'           , 'EventsController@addAmendCarPark');
     
    // Event Management: Create / Edit
    Route::get('admin/events/event-create-edit/', 'EventsController@createEditForm');
    Route::post('admin/events/event-create-edit/', 'EventsController@createEditEvent');

    // orders
    Route::get('admin/orders/'       , function () { return view('admin.orders'); });
    Route::get('admin/orders/data'   , 'DatatablesController@getOrdersData' );
//    Route::get('admin/orders/view'   , function(){ return view('admin.orders-view'); });
    Route::get('admin/orders/view'   , 'Order\OrderController@viewOrderDetails');

    Route::get('admin/print-sheets-plate-number'   , 'PrintSheetsController@printSheetsByPlateNumber');
    Route::get('admin/print-sheets-name'   , 'PrintSheetsController@printSheetsByName');
    
    // ui examples
    Route::get('shell/',        function () { return view('admin.shell');  });
    Route::get('style-guide/',  function () { return view('admin.style-guide'); });

    // Data Table Examples (these can be removed later when other data tables have been created)
    Route::get('datatable-users'      ,         function(){ return view('admin.datatable-users'); });
    Route::get('datatable-users/data' ,         'DatatablesController@getUsersData');

    Route::get('datatable-categories'      ,    function(){ return view('admin.datatable-categories'); });
    Route::get('datatable-categories/data' ,    'DatatablesController@getCategoriesData');

    Route::get('admin/orders/update-email/'            , 'Order\OrderController@saveEmail');       

    // users
    Route::get('admin/users/'       , function () { return view('admin.users.users'); });
    Route::get('admin/users/data'   , 'DatatablesController@getUsersData' );
    Route::get('admin/users/add-edit'   , 'UserController@addAmendForm');
    Route::post('admin/users/add-edit'  , 'UserController@addAmendUser');

    // Categories
    Route::get('admin/categories/'      , function () { return view('admin.categories.categories'); });
    Route::get('admin/categories/data'          , 'DatatablesController@getCategoriesData' );
    Route::get('admin/categories/add-edit'   , 'CategoryController@addAmendForm');
    Route::post('admin/categories/add-edit'  , 'CategoryController@addAmendCategory');

    // Car Parks
    Route::get('admin/carparks'             , function(){ return view('admin.carparks.carparks'); });
    Route::get('admin/carparks/data'        , 'DatatablesController@getCarParksData' );
    Route::get('admin/carparks/add-edit'    , 'CarParksController@addAmendForm');
    Route::post('admin/carparks/add-edit'  ,  'CarParksController@addAmendCarPark');

    // Teams
    Route::get('admin/teams'             , function(){ return view('admin.teams.teams'); });
    Route::get('admin/teams/data'        , 'DatatablesController@getTeamsData');
    Route::get('admin/teams/add-edit'    , 'TeamsController@addAmendForm');
    Route::post('admin/teams/add-edit'  ,  'TeamsController@addAmendTeam');

    // Wastage Reasons
    Route::get('admin/wastage-reasons'              , function(){ return view('admin.wastage-reasons.wastage-reasons'); });
    Route::get('admin/wastage-reasons/data'         , 'DatatablesController@getWastageReasonsData');
    Route::get('admin/wastage-reasons/add-edit'     , 'WastageReasonsController@addAmendForm');
    Route::post('admin/wastage-reasons/add-edit'    ,  'WastageReasonsController@addAmendWastageReason');
    
//    Route::get('admin/temp/mail-shot/'            , 'TempController@mailShot');       
    Route::get('admin/temp/cancel-order/'            , 'TempController@cancelOrder');       
    
    Route::get('/admin/impersonate', 'UserController@impersonate');
    

});


Route::group(['middleware' => ['web']], function () {

    /*
    |--------------------------------------------------------------------------
    | Static pages not needing a controller
    |--------------------------------------------------------------------------
    |
    |
    */
    
    Route::get('faq/', function () {
        return view('site.faq');
    });
    Route::get('terms/', function () {
        return view('site.terms');
    });
    Route::get('privacy-policy/', function () {
        return view('site.privacy-policy');
    });

    Route::get('entry-check', function(){
        return view('entry-check.search');
    });

    Route::get('entry-check-app', function(){
        return view('entry-check-app.search');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Routines for guest visitors
    |--------------------------------------------------------------------------
    |
    | Anyone can access these pages.
    |
    */

    Route::get('/'                                  , 'HomeController@getUpcoming');              // Load all events
    Route::get('events/'                            , 'EventsController@getUpcoming');              // Load all events
    Route::get('events/details/{id}'                , 'EventsController@getOne');                   // Load single event details
    Route::get('basket/'                            , 'Order\BasketController@getAll');                   // Load basket
    Route::get('basket/add/{pid}'                   , 'Order\BasketController@addSingle');                      // Add to basket
    Route::get('basket/remove-single/{pkey}'        , 'Order\BasketController@removeSingle');            // Remove product from basket
    Route::get('basket/remove-multi/{mkey}'         , 'Order\BasketController@removeMulti');
    Route::get('basket/season/add/{mid}'            , 'Order\BasketController@addMulti');                // Remove product from basket           
    Route::get('car-parks/'                         , 'CarParksController@getFeatured');
    Route::get('season-tickets/'                    , 'MultiTicketsController@getUpcoming');        // Load multi tickets
    Route::get('season-tickets/details/{id}'        , 'MultiTicketsController@getDetails');         // Load multi tickets details   

    Route::get('auth/'                              , 'Auth\AuthController@index');                 // Load login form
    Route::get('auth/logout/'                       , 'Auth\AuthController@getLogout');             // Logout requested
    Route::get('auth/message/'                      , 'Auth\AuthController@getMessageView');        // Show a message
    Route::get('auth/register/'                     , 'Auth\AuthController@getRegister');           // Load register form
    Route::get('auth/forgot-password/'              , 'Auth\AuthController@getForgotPassword');     // Load Forgot Password form
    Route::get('auth/validate-access/'              , 'Auth\AuthController@getValidateAccess');     // Load Validate Access form
    Route::get('auth/reset-password/'               , 'Auth\PasswordController@getResetPassword');      // Load Reset Password form
    Route::get('auth/create-password/'              , 'Auth\PasswordController@getCreatePassword');      // Load Reset Password form

    Route::get('get-webapp-data/'                   , 'GenerateDataController@forWebApp');      
    
//    Route::get('test/'                              , 'Auth\PasswordController@index');      // Load Reset Password form
//    Route::get('clean-users/'                       , 'Auth\CleanDatabaseController@cleanUsers');      
//    Route::get('clean-addresses/'                   , 'Auth\CleanDatabaseController@cleanAddresses');      
//    Route::get('clean-plates/'                         , 'Auth\CleanDatabaseController@cleanPlates'); 
    
//    Route::get('import-guest-list/'                , 'Auth\ImportGuestListController');  
    Route::get('test/', 'DatatablesController@getOrdersData');
    
    /*
    |--------------------------------------------------------------------------
    | A guest accessing a protected route
    |--------------------------------------------------------------------------
    |
    | Auth middleware redirects all 'guest' users (ie, users not logged-in) to 
    | login/ route if they try to access a protected route. Adding an extra
    | line of route here to cater for that. Could've changed this in the
    | app/Http/Middleware/Authenticate.php but upgrading base laravel installation
    | in future would cause 404 errors if I changed Authenticate.php
    |
    | Ayyaz Hussain.
    |
    */
    Route::get('login/'                     , 'Auth\AuthController@index');                 // Load login form
    
    /*
    |--------------------------------------------------------------------------
    | All form posts
    |--------------------------------------------------------------------------
    |
    | Any form posts should go in here.
    |
    */
    Route::post('auth/register/'               , 'Auth\AuthController@postRegister');            // Submit Register form
    Route::post('account/change-password/'     , 'Auth\PasswordController@postChangePassword');  // Submit Change Password request       
    Route::post('account/edit-profile/'        , 'Auth\PasswordController@postEditProfile');     // Submit Edit Profile request    
    Route::post('auth/forgot-password/'        , 'Auth\AuthController@postForgotPassword');      // Submit Forgot Password form
    Route::post('auth/validate-access/'        , 'Auth\AuthController@postValidateAccess');      // Submit Validate Access form
    Route::post('auth/reset-password/'         , 'Auth\PasswordController@postResetPassword');       // Submit Reset Password form
    Route::post('auth/create-password/'        , 'Auth\PasswordController@postCreatePassword');       // Submit Reset Password form

    Route::get('send-reminders/'                     , 'SendReminderController@index');                 // Load login form
    Route::get('fix-phones/'                         , 'DataFixesController@removeInvalidPhoneNumbers');                 // Remove short phone numbers

    Route::get('/admin/stop-impersonating', 'UserController@stopImpersonate');    
    
});

/*
|--------------------------------------------------------------------------
| Protection against throttling/brute-force-attach
|--------------------------------------------------------------------------
|
| Max 20 failed attempts allowed in 1 min before account is locked for 60 seconds.
|
*/
Route::group(['middleware' => ['web', 'throttle:20,1']], function () {

    Route::post('auth/'                         , 'Auth\AuthController@postLogin');              // Submit Login form
});



