<?php

namespace App\Http\Controllers\Auth;

use Log;
use App\User;
use Validator;
use App\Classes\Postman;
use App\Classes\Authenticate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\EstController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends EstController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Display a login-register view.
     *
     * @return View
     */
    public function index() {
        return view('site.auth.login-register');
    }
    
    /**
     * Display a new register view.
     *
     * @return View
     */
    public function getRegister() {
        return view('site.auth.register');
    }
    
    /**
     * Process register form.
     *
     * @return void
     */
    public function postRegister() {
        
        //
        // Define custom messages.
        $messages = array(
            'email.unique'=>'An account already exists with this email, please either reset your password or use a different email address.',
        );        
        
        //
        // Set validation rules
        $rules = array(
            'user_firstname' => 'required|string|max:255',
            'user_surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'user_password'  => 'required|min:5',
        );
        
        //
        // Apply validation rules
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ( $validator->fails() ) {
        //
        // Validation failed
        //
        //
            //
            // Return back to register view with error messages and data pre-filled
            return Redirect::back()->withInput()->withErrors($validator);
            
        } else {
        //
        // Validation successful
        //
        
            $submittedData = Input::all();
            Log::info('Attempting to create a new user account: '.  json_encode( Input::except('user_password', 'user_password_confirm') ) );            

            
            
            //
            // Create a user record in the database
            $created = $this->create( Input::all() );
            
            if ( $created['status'] == _RETURN_STATUS_PASS_ ) {
            //
            // Record created successfully
            //

                Log::info('Registration, intended URL is: '. Session::get('url.intended'));
                
                //
                // Basket is coded to store single and season (multi) tickets separately.
                // Check for both variables to see if a valid baskets exists or not
                if ( \App\Classes\Basket::basketExists() && ( strpos(Session::get('url.intended'), 'checkout/details') !== FALSE ) ) {
                    
                    //
                    // Validate user as part of Registration process when done as part of Checkout process
                    $User = User::find($created['id']);
                    self::validateUserAccess( $User );
                    
                    //
                    // 'Attempt' to authenticate newly created user.
                    if (Auth::attempt(['email' => $User->email, 'password' => Input::get('user_password'), 'status' => 'Active'])) {
                    //
                    // Authentication passed
                    // 

                        Log::info('User authentication passed as part of Registeration: '. json_encode( Auth::user() ));

                        //
                        // Redirect to 'intended' URL, otherwise to My Account home.
                        return redirect()->intended('account/');

                    } else {
                    //
                    // Authentication failed
                    // 

                        Log::error('User authentication failed as part of Registration.');

                        //
                        // Create a message & send it back to the login view.
                        $validator->errors()->add('authentication', 'Email and password combination not found.');
                        return Redirect::to('auth/')->withErrors($validator);
                    }            
                    
                }
                
                Log::info('User account created successfully with id: '.  $created['id'] );            
                $User = User::find($created['id']);
                
                if ( \App\Classes\Tools::isPhoneBooking( $User->email ) ) {

                    Log::info('It is a phone booking so no email sent.');
                    return Redirect::to('auth/message?action=confirmRegister');
                }
                
                //
                // Send out confirmation email
                $registerPostman = new Postman( $User );
                
                if ( $registerPostman->sendEmailForRegistration() ) {
                    // REturn to previous page with a message
                    Session::flash('info', 'We have sent an email to: '.$User->email.'. Please check your email inbox or spam folder for the email and follow the instructions in the email.');
                } else {
                    //Return to previous pageg with an error
                    Session::flash('error', 'Your account needs confirmation but there appears to be a problem sending instructions to your email address: '.$User->email.'.');
                }                

                return Redirect::to('auth/message?action=confirmRegister');
                
            } else {
            //
            // Failed to create a user record in the database
            //
            
                Log::critical('Failed to create user account. Error: '.  $created['err_code'].' - '.$created['err_message'] );            
                
                //
                // Create a message & send it back to the register view
                $validator->errors()->add('register', 'Unable to register, please try again or contact us quoting error code '.$created['err_code']);                
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }        
        
    }
    
    /**
     * Process logout request.
     *
     * @return View
     */    
    public function getLogout() {
        
        Auth::logout();
        return Redirect::to('/');
    }
    
    /**
     * Process login request.
     *
     * @return void
     */
    public function postLogin() {

        //
        // Set validation rules
        $rules = array(
            'user_email' => 'required|email|max:255',
            'user_password'  => 'required|min:5',
        );
        
        //
        // Apply validation rules
        $validator = Validator::make(Input::all(), $rules);

        if ( $validator->fails() ) {
        //
        // Validation failed
        //
            
            Log::error('User logging in but provided invalid login information: '. Input::get('user_email'));
            
            //
            // Return back to login view with error messages and data pre-filled.
            return Redirect::back()->withInput()->withErrors($validator);
            
        } else {
        //
        // Validation successful
        //

            Log::info('User logging in with valid login information: '. Input::get('user_email'));
            
            
            //
            // Check if password field exists for this user, if so then continue otherwise break to a password reset routine
            $User = User::where( 'email', Input::get('user_email') )->first();
            if ( $User && !(BOOL)strlen(trim($User->password)) ) {
                
                //
                // Basket is coded to store single and season (multi) tickets separately.
                // Check for both variables to see if a valid baskets exists or not
                if ( Session::has('single') || Session::has('multi') ) {

                    //
                    // If a valid basket exists then don't take the user down the email route.
                    // Redirect the user to Create New Password
                    $token = Authenticate::generateGuidToken($User);
                    $tokenValid = (INT)( strlen($token) == _PASSWORD_RESET_TOKEN_LENGTH_ );

                    Session::flash('migrate_user', "Your password has expired, please use the form below to create a new password.");                
                    return view('site.auth.create-password', compact('tokenValid', 'User'));
                    
                } else {

                    Session::flash('migrate_user', "Your password has expired, please use the form below to create a new password. Type or confirm your email address that was used to create the account and click 'Send reset email' button.");                
                    return view('site.auth.reset-password', ['email' => $User->email]);
                }
                
            }
                        
            //
            // 'Attempt' to authenticate user (see if user exists in our database).
            if (Auth::attempt(['email' => Input::get('user_email'), 'password' => Input::get('user_password'), 'status' => 'Active'])) {
            //
            // Authentication passed
            // 

                Log::info('User authentication passed: '. json_encode( Auth::user() ));

                //
                // Redirect to 'intended' URL, otherwise to My Account home.
                return redirect()->intended('account/');
                
            } else {
            //
            // Authentication failed
            // 
             
                Log::error('User authentication failed.');
 
                //
                // Create a message & send it back to the login view.
                $validator->errors()->add('authentication', 'Email and password combination not found.');                
                return Redirect::back()->withInput()->withErrors($validator);
            }            
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Array
     */
    protected function create(array $data)
    {
        
        try {
            
            $user = new User();
            $user->role_id         = _ROLE_REGISTERED_;
            $user->language_id     = _LANG_ID_; 
            $user->firstname        = $data['user_firstname'];
            $user->lastname         = $data['user_surname'];
            $user->password         = bcrypt($data['user_password']);
            $user->email            = $data['email'];
            $user->type             = _USER_TYPE_REGISTERED_; 
            $user->status           = _STATUS_INACTIVE_;
            
            $user->save();
            
            //
            // Check if it's a phone booking
            if ( $user->email == 'phone@estuk.co.uk' ) {
                
                //
                // Update user record with new email address
                $newEmail = str_replace('@', '_'.$user->id.'@', $user->email);
                $user->email = $newEmail;
                
                $user->save();
                Log::info('It is a phone booking, updated email address to: '.$newEmail);
            }
            
        } catch (\Exception $e) {
            return array('status' => 'fail', 'err_code' => $e->getCode(), 'err_message' => $e->getMessage());
        }        
        return array('status' => 'pass', 'id' => $user->id);
    }
    
    /**
     * Show a generic message view.
     *
     * @return View
     */
    public function getMessageView() {
        
        $action = Input::get('action');
        
        return view('site.auth.message', compact('action'));
    }
    
    /**
     * Validate a user access.
     *
     * @return View
     */
    public function getValidateAccess() {
        
        $token = Input::get('token');
        $tokenValid = (INT)( strlen($token) == _PASSWORD_RESET_TOKEN_LENGTH_ );
        Log::info('Validate access requested with token: '.$token); 
        
        
        //
        // Find a user based on the given token
        $User = User::where('remember_token', 'LIKE', '%'.$token.'|||%')->first();
        if ( !$User ) {
            $User = User::where('remember_token', $token)->first();
        }

        $authToken = new Authenticate( $User );
        if ( $authToken->tokenValid($token) ) {
            
            try {
                
                if (self::validateUserAccess($User)) {
                    
                    Log::critical('User record validated for user: '. json_encode($User));
                    Session::flash('info', 'Your account is now validated, you may login.');            
                }
                
            } catch (\Exception $e) {

                Log::critical('Error occurred while attempting to validate user record for user: '. json_encode($User));
            
                Session::flash('error', 'Unable to validate your account, please try again or contact us if problem persists.');            
                return Redirect::to('/auth/message');

            }
        } else {
            
            Log::critical('Validate access requested - error occurred while attempting to validate token for user: '. json_encode($User));
            Session::flash('error', 'Invalid token, please try again or contact us if problem persists.');            
            return Redirect::to('/auth/message');
        }
        return Redirect::to('/auth');
        
    }
    
    /**
     * Update the user record to make the record ACTIVE.
     *
     * @return View
     */
    private static function validateUserAccess( $User ) {
        
        $User->language_id     = _LANG_ID_; 
        $User->remember_token   = '';
        $User->status           = _STATUS_ACTIVE_;

        Log::info('Attempting to validate user access for user: '. json_encode($User));
        return $User->save();

    }
}
