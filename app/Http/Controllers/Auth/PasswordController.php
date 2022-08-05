<?php

namespace App\Http\Controllers\Auth;

use Log;
use App\User;
use Validator;
use App\Classes\Postman;
use App\Classes\Authenticate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\EstController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends EstController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function index() {
        
        // ******************************
        // For testing purposes
        $firstname = 'Ayyaz';
        $password_reset_link = 'https://www.example.com/link';
        return view('site.emails.password_reset', compact('firstname','password_reset_link'));
        //
        //*******************************
    }
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
     * Process Create Password form.
     *
     * @return View
     */
    public function postCreatePassword() {

        $type = 'create-password';
        
        $validator = $this->validateCreatePasswordForm(Input::all());
        if ( $validator->fails() ) {
            //
            // Return back to register view with error messages and data pre-filled
            return Redirect::back()->withInput()->withErrors($validator);
            
        } else {
        //
        // Validation successful, reset password in the user record.
        //
            
            //
            // Get user object based on the given user_id
            $User = User::find( Input::get('user_id') );
            if ( !(BOOL)$User ) {
                Log::critical( $type.' requested but failed to find a matching record');            

                // Create a message & send it back to the view
                $validator->errors()->add($type, 'Unable to find a matching record, please try again or contact us.');                
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            Log::info( $type.' requested - a matching user record found.');            
            
            
        
            
            //
            // As an extra check, make sure reset password token saved in 
            // out db matches the one that comes through the post.
            $validationCheck = new Authenticate( $User );
            $validationCheck->tokenExpired(Input::get('password_reset_token'), $type);
            try {            
                
                $User->password         = bcrypt(Input::get('password'));
                $User->remember_token   = '';
                $User->status           = _STATUS_ACTIVE_;

                Log::info('Attempting to reset user record for user: '. json_encode($User));
                $User->save();

            } catch (\Exception $e) {
                
                Log::critical('Error occurred while attempting to reset user record for user: '. json_encode($User));
                //
                // Return back to view with error messages 
                $validator->errors()->add('password-reset', 'Unable to make the change, please try again or contact us if problem persists.');                
                return Redirect::back()->withErrors($validator);
            }        

            Log::info('Password reset request complete for user: '. json_encode($User));
            Session::flash('info', 'Your password has now been updated.');
            
            return Redirect::to('/auth');

        }       
        
    }
    
    /**
     * Construct Create Password form.
     *
     * @return boolean
     */
    public function getCreatePassword() {
        
        //
        // Get and validate token
        $token = Input::get('token');
        $tokenValid = (INT)( strlen($token) == _PASSWORD_RESET_TOKEN_LENGTH_ );
        Log::info('Create new password function requested with token: '.$token); 
        
        
        //
        // Find a user based on the given token
        $User = User::where('remember_token', 'LIKE', '%'.$token.'%')->first();
        
        
        $validUserFound = 0;
        $tokenExpired = 0;

        $authToken = new Authenticate( $User );
        $validUserFound = $authToken->tokenValid($token); 
        $tokenExpired = $authToken->tokenExpired($token);
                
        if ( $tokenExpired ) {

            //
            // If token expired then, set a suitable message and redirect to Password Reset page. 
            //
            
            Log::critical('Password reset request expired, token: '.$token);            
            Session::flash('error', 'Your request to reset password has now expired. You may try again.');
            
            return Redirect::to('/auth/reset-password');
        }
        
        if ( !$validUserFound || !$token || !(strlen($token) == _PASSWORD_RESET_TOKEN_LENGTH_) ) {
            
            //
            // Set a suitable message and show Create Password form with form hidden
            // if any of the following is true:
            //  - No valid user found for the given token
            //  - No token found
            //  - Token is not the correct length
            
            $User = new User();
            $tokenValid = 0;
            Log::critical('Invalid request - token not as expected: '.$token);            
            Session::flash('error', 'Invalid request. Unable to continue with your request.');
            return view('site.auth.create-password', compact('tokenValid', 'User'));
        }
        
        
        return view('site.auth.create-password', compact('tokenValid', 'User'));
    }
    
    /**
     * Construct Reset Password form.
     *
     * @return View
     */
    public function getResetPassword() {
        
        $email = '';
        if ( (BOOL) strlen(trim(Input::get('email'))) ) {
            $email = Input::get('email');
        }
        return view('site.auth.reset-password', compact('email'));
    }
    
    /**
     * Process Reset Password form.
     *
     * @return View
     */
    public function postResetPassword() {
        
        $type = 'password-reset';
        Log::info($type.' requested for email address: '.Input::get('email'));            
        
        $validator = $this->validateResetPasswordForm(Input::all());

        if ( $validator->fails() ) {
            //
            // Return back to register view with error messages and data pre-filled
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
        //
        // Validation successful
        //
            
            $User = User::where('email', Input::get('email'))->first();            
            if ( !(BOOL)$User ) {
                Log::critical( $type.' requested but failed to find a matching record');            

                // Create a message & send it back to the view
                $validator->errors()->add($type, 'Unable to find a matching record, please try again or contact us.');                
                return Redirect::back()->withInput()->withErrors($validator);
            }
            
            Log::info( $type.' requested - a matching user record found.');            
            
            $saved = 0;
            try {
                
                $saved = $User->save();
                
            } catch (\Exception $e) {
                
                Log::critical( $type.' requested but unable to update user record: '. json_encode($User));            
                
                // Create a message & send it back to the view
                $validator->errors()->add($type, 'An error occurred while updating your record, please try again or contact us quoting error code '.$e->getCode());                
                return Redirect::back()->withInput()->withErrors($validator);
            }        
            
            if ( $saved ) {
                
            //
            // User record updated. Now send out the email.
            //
                Log::info( $type.' requested - record updated & attempting to send email. User object: '. json_encode($User));    
                
                $resetPasswordPostman = new Postman( $User );
                
                if ( $resetPasswordPostman->sendEmailForPasswordReset() ) {
                    // REturn to previous page with a message
                    Session::flash('info', 'Your password reset email has been sent. Please check your email inbox or spam folder for the email and follow the instructions in the email.');
                    return Redirect::to('auth/reset-password');
                } else {
                    //Return to previous pageg with an error
                    $validator->errors()->add('password-reset', 'Sending of email failed, please try again or contact us.');                
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                        
            } else {
                
                // Create a message & send it back to the view
                $validator->errors()->add($type, 'Unable to update your record, please try again or contact us quoting error code '.$e->getCode());                
                return Redirect::back()->withInput()->withErrors($validator);
            }        
            
        }        

    }
    
    /**
     * Validate data submitted on the Create Password form.
     *
     * @return boolean
     */
    private function validateCreatePasswordForm($data) {
        
        //
        // Set validation rules
        $rules = array(
            'password'  => 'required|min:5|confirmed',
            'password_confirmation'  => 'required|min:5'
        );
        //
        // Apply validation rules
        return Validator::make($data, $rules);
    }
    
    /**
     * Validate data submitted on the Reset Password form.
     *
     * @return boolean
     */
    private function validateResetPasswordForm($data) {
        
        //
        // Set validation rules
        $rules = array(
            'email' => 'required|email|max:255'
        );
        
        return Validator::make($data, $rules); 
   }
   
}
