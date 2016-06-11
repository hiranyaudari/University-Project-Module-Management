<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
//	public function __construct(Guard $auth)
//	{
//		$this->auth = $auth;
//	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		try {
            $loggedUser = Sentinel::check();

            if($loggedUser) {
                return $next($request);
            }

            else {
                if (Sentinel::guest()) {
                    if ($request->ajax()) {
                        abort('403');
                    } else {
                        return \Redirect::to('login');
                    }
                }
            }
        }

        catch(\BadMethodCallException $bmce) {
            return abort('403');
        }

        catch(\Exception $e) {
            dd($e.getMessage());
            return view('errors.500');
        }


	}

}
