<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class RequestIsAjax
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->ajax())
            return $next($request);

        return abort(404);
    }
}
