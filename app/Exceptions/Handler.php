<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ( is_a($e, 'TokenMismatchException')) {
            return redirect::to('auth/')->with('errors', 'For security reasons, you have been signed out. Please Sign In again.');
        }

        //
        // To handle 'oops...' type of errors
        if ( !$this->isHttpException($e) ) {
            
            $message = $e->getMessage();
            if ( \Auth::user() ) {
                $message = ' User: '.\Auth::user()->id.' - '.\Auth::user()->getFullname().' - '.$e->getMessage();
                echo $message;
                die();
            }            
            \Log::critical('An error occured: ' .$message);
            return response()->view('errors.500', [], 500);
        }
        
        

        return parent::render($request, $e);
    }
}
