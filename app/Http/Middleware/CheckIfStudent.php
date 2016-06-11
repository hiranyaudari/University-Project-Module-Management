<?php namespace App\Http\Middleware;

use Closure;
use Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class CheckIfStudent {

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
            if(Sentinel::inRole('students')) {
                return $next($request);
            }

            else {
                return Redirect::to('/');
            }
        }

        catch(\BadMethodCallException $bmce) {
            return abort('403');
        }

//        catch(\Exception $e) {
//            dd($e.getMessage());
//            return view('errors.500');
//        }

    }

}
