<?php

namespace App\Http\Middleware;

use Closure;
use Auth,Route;
class checkpermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {//print_r("expression");exit;
		$array = json_decode(Auth::User()->permission);
        //print_r($array);exit;
	//	dd(Route::currentRouteName());
		if(Auth::id() > 1)
		{
			if(!in_array(Route::currentRouteName(), $array))
			{
				return redirect('denied');
			}
		}
        return $next($request);
    }
}
