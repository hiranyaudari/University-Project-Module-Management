<?php namespace App\Exceptions;

use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Session, Redirect;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
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
		return parent::report($e);
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
//        if ($e instanceof \Swift_TransportException) {
//            Session::flash('message_error','Error when sending emails.');
//            return response()->view('errors.500');
//        }
//
//        if ($e instanceof \PDOException) {
//            Session::flash('message_error','Error when retrieving values from the database.');
//            return response()->view('errors.500');
//        }
//
//        elseif ($e instanceof QueryException) {
//            Session::flash('message_error','Error when retrieving values from the database.');
//            return response()->view('errors.500');
//        }
//
//        elseif ($e instanceof DecryptException) {
//            Session::flash('message_error','Error encountered when decrypting the URL');
//            return response()->view('errors.500');
//        }
//
//        elseif ($e instanceof ThrottlingException) {
//            Session::flash('message_error','Maximum number of login attempts reached. Try again after '. $e->getDelay() .' seconds');
//            return Redirect::back();
//        }
//
//        elseif ($e instanceof \BadMethodCallException) {
//            return response()->view('errors.403');
//        }

//        return response()->view('errors.500');
		return parent::render($request, $e);
	}

}
