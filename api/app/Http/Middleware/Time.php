<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Time
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $timeJudge = timeJudge();
        if ($timeJudge === 5) {
            return response([
                'errno' => 404,
                'errmsg' => '该活动已过期。'
            ]);
        }
        if ($timeJudge > 0
        && User::where('openid', $_SESSION['openid'])->first() == null) {
            return response([
                'errno' => 102,
                'errmsg' => '你未能及时提交数据，无法继续参加本次活动。'
            ]);
        }
        return $next($request);
    }
}
