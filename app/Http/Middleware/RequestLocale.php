<?php

namespace App\Http\Middleware;

use Closure;

class RequestLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!empty($request->header('lang')) && in_array($request->header('lang'), ['vi', 'en'])){
            $lang = $request->header('lang');
            app('translator')->setLocale($lang);
        } else {
            app('translator')->setLocale(config('app.locale'));
        }
        return $next($request);
    }
}
