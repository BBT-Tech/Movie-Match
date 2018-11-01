<?php

namespace App\Http\Middleware;

use \Illuminate\Http\Request;

class Login {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, $next) {
        if (isset($_SESSION['openid'])) {
            return $next($request);
        }
        return response([
            'errno' => 100,
            'errmsg' => '你还没有登录。'
        ]);
    }
}
