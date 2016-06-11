<?php namespace App\Http\Middleware;

use Closure;
use PhpSpec\Exception\Exception;
use Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class CheckIfRPC {

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
            if(Sentinel::inRole('rpc')) {
                return $next($request);
            }

            else {
                return Redirect::to('/');
            }
        }

        catch(\BadMethodCallException $bmce) {
            return abort('403');
        }

        catch(Exception $ex) {
            //dd($ex.getMessage());
            return view('errors.500');
        }

	}

}
