<?php

date_default_timezone_set('Europe/London');

define('_SITE_NAME_'    , 'Ricoh Arena Official Parking');
define( '_LANG_ID_'     , 1 );
define('_CURRENCY_' , 'GBP');
define('_ROOT_URL_'     , env('ROOT_URL', 'http://ricoharenaparking.co.uk/') );
define('_ACCOUNT_URL_'  , _ROOT_URL_ . 'account');
define('_CAR_PARKS_URL_', _ROOT_URL_ . 'car-parks');

// Email templates
define('_TEMPLATES_PASSWORD_RESET_'         , '/templates/password_reset.html');
define('_TEMPLATES_1WEEK_REMINDER_', 'site.emails.one_week_reminder');
define('_TEMPLATES_1DAY_REMINDER_', 'site.emails.one_day_reminder');
define('_TEMPLATES_0DAY_REMINDER_', 'site.emails.on_the_day_reminder');
define('_TEMPLATES_MAILSHOT_BS_', 'site.emails.email_shot_bs');

define('_PASSWORD_RESET_TOKEN_LENGTH_'      , 50); //Must not exceed 80
define('_PASSWORD_RESET_TOKEN_LIFE_HRS_'    , 24);

define('_ORDER_REF_LENGTH_'     , 8);
define('_ORDER_REF_MIN_'     , 11111111);
define('_ORDER_REF_MAX_'     , 99999999);

//
// Ticket types for PDF eTicket
define('_TICKET_TYPE_SINGLE_VS_'     , 'single_vs');
define('_TICKET_TYPE_SINGLE_'        , 'single');
define('_TICKET_TYPE_MULTI_'        , 'multi');
define('_TICKET_TYPE_GUEST_'        , 'guest');
define('_TICKET_TYPE_SEASON_'        , 'season');

//
// Basket specific constants
define('_BASKET_TEXT_'              , 'basket');


// Define User Types
define( '_USER_TYPE_GUEST_'         , 'guest' );
define( '_USER_TYPE_REGISTERED_'    , 'registered' );

//
// Define Status
define('_STATUS_ACTIVE_'    , 'active');
define('_STATUS_INACTIVE_'  , 'inactive');
define('_STATUS_ALL_'       , 'all');

define('_STATUS_MULTI_TICKET_ONLINE_', 'online');
define('_STATUS_ONLINE_'            , 'online');
define('_STATUS_OFFLINE_'           , 'offline');
define('_STATUS_PRIVATE_'           , 'private');
define('_STATUS_DISABLED_'          , 'disabled');

//
// Define Order status types
define('_ORDER_STATUS_SUCCESSFUL_'      ,'Successful');
define('_ORDER_STATUS_PENDING_'         ,'Pending');
define('_ORDER_STATUS_FULLYREFUNDED_'   , 'Fully Refunded');
define('_ORDER_STATUS_PARTLYREFUNDED_'  , 'Partly Refunded');
define('_ORDER_STATUS_CANCELLED_'       , 'Cancelled');

//
// Define User Roles Ids
define('_ROLE_ADMIN_'       , 1);
define('_ROLE_REGISTERED_'  , 2);
define('_ROLE_GUESTLIST_'   , 3);

//
// Define User Roles Text
define('_ROLE_ADMIN_TEXT_'  		, 'Admin');
define('_ROLE_REGISTERED_TEXT_'  	, 'Registered');
define('_ROLE_GUESTLIST_TEXT_'  	, 'Guest List');

//
// Function call status
define('_RETURN_STATUS_PASS_'    , 'pass');
define('_RETURN_STATUS_FAIL_'    , 'fail');

define('_MESSAGE_ACTION_REGISTER_THANKYOU_'         , 'confirmRegister');
define('_MESSAGE_ACTION_REGISTER_VALIDATE_'         , 'validateRegister');
define('_MESSAGE_ACTION_PASSWORD_RESET_CONFIRM_'    , 'confirmPasswordReset');

define('_LINK_VALIDATE_ACCESS_URL_'    , 'auth/validate-access');
define('_LINK_CREATE_PASSWORD_URL_'     , 'auth/create-password');
define('_EMAIL_GENERIC_FROM_EMAIL_'     , env('MAIL_FROM_EMAIL'));
define('_EMAIL_GENERIC_FROM_NAME_'     , env('MAIL_FROM_NAME'));

//
// Stripe API keys
define('_STRIPE_PRIVATE_KEY_'           , env('STRIPE_PRIVATE_KEY'));
define('_STRIPE_PUBLIC_KEY_'           , env('STRIPE_PUBLIC_KEY'));
define('_STRIPE_TOKEN_NAME_'            , 'stripeToken');
define('_STRIPE_ERROR_1_'               , 'No pending order.');
define('_STRIPE_STATEMENT_DESCRIPTOR_'  , 'Ricoh Coventry');
//define('_STRIPE_RESPONSE_SUCCEEDED_'    , env('STRIPE_RESPONSE_STATUS', 'succeeded') );
define('_STRIPE_RESPONSE_SUCCEEDED_'    , 'succeeded' );
define('_STRIPE_RESPONSE_PAID_'         , 'paid' );

//
// Refund before
define('_REFUND_BEFORE_IN_HRS_'     , 12);

define('_REFUND_REASON_CUSTOMER_REQ_'   , 'requested_by_customer');
define('_REFUND_REASON_FRAUDULENT_'     , 'fraudulent');
define('_REFUND_REASON_DUPLICATE_'      , 'duplicate');

define('_REMINDER_1WEEK_',  '1-week');
define('_REMINDER_1DAY_',  '24-hour');
define('_REMINDER_ON_THE_DAY_',  '0-day');
define('_REMINDER_TIME_FROM_', '09:00');
define('_REMINDER_TIME_TO_', '17:00');
define('_REMINDER_FRI_', 'friday');
define('_REMINDER_MON_', 'monday');
define('_REMINDER_SAT_SUN_', 'saturday,sunday');

define('_EVENT_TYPE_VS_'    , 'team');
define('_EVENT_TYPE_NON_VS_', 'single');

//
// Status percentages
define('_STATUS_RED_', 		10);
define('_STATUS_AMBER_', 	30);

define('_FILTER_TEXT_ORDER_BY_' , 'orderBy');
define('_FILTER_TEXT_CAT_ID_' , 'categoryId');
define('_FILTER_TEXT_STATUS_' , 'status');
define('_FILTER_TEXT_INC_OLD_' , 'includeOld');
define('_DEFAULT_FILTER_INC_OLD_' , false);
define('_DEFAULT_FILTER_STATUS_' , 'all');
define('_DEFAULT_FILTER_CAT_ID_' , 0);
define('_DEFAULT_FILTER_ORDER_BY_' , 'date');

define('_ORDER_BY_EVENTS_'     , 'date,title');
define('_STATUSES_EVENTS_'      , 'all,active,inactive');

define('_CARPARK_SOLD_FIGURE_'  , 100);
define('_CARPARK_LIMITED_FIGURE_' , 80);
define('_CARPARK_SOLD_TEXT_'     , 'sold');
define('_CARPARK_LIMITED_TEXT_'     , 'limited');
define('_CARPARK_AVAILABLE_TEXT_'     , 'available');

//
// Default Meta Data
define('_META_TITLE_', 'Ricoh Arena Official Parking. Coventry City Football Club Parking. Wasps Rugby Football Club Parking');

define('_META_DESCRIPTION_', 'Official Parking for the Ricoh Arena Stadium. Coventry City Football Club Parking. Wasps Rugby Football Club Parking.');

define('_META_KEYWORDS_', 'Ricoh Arena Official Parking, Coventry City Football Club Parking, Wasps Rugby Football Club Parking, Ricoh Parking, Ricoh Official Parking');


