<?php

namespace App\Http\Middleware;

use \Illuminate\Http\Request;

class GlobalInit {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, $next) {
        session_start();
        set_error_handler(function () { return new \Exception; });
        return $next($request);
    }
}
