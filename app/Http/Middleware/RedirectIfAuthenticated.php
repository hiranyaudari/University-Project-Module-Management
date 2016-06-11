<?php namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated {

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
            if (Sentinel::guest()) {
                return \Redirect::to('login');
            }

            return $next($request);

        }

        catch(\BadMethodCallException $bmce) {
            return abort('403');
        }

        catch(\Exception $e) {
//            dd($e.getMessage());
            return view('errors.500');
        }
	}

}
