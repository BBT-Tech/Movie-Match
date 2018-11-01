<?php

namespace App\Http\Middleware;

use Validator;
use Closure;

class Validate {
    private static $validList = [
        'register' => [
            'gender' => 'required|integer|between:0,1',
            'name' => 'required|string|between:1,25',
            'age' => 'required|integer|between:0,200',
            'grade' => 'required|integer|between:1,7',
            'college' => 'required|integer|between:0,9',
            'school' => 'required|string|between:1,40',
            'tel' => ['required', 'string', 'regex:/^1\d{10}$/'],
            'wechat' => ['nullable', 'string', 'regex:/^[a-z][\w\-]{5,19}$/i'],
            'tagender' => 'required|integer|between:0,1',
            'movie' => 'required|integer|between:0,4',
            'points' => 'required|array',
            'points.t_top' => 'required|numeric',
            'points.t_bottom' => 'required|numeric',
            'points.h_end_top' => 'required|numeric',
            'points.p_top.*' => 'required|numeric',
            'points.p_bottom.*' => 'required|numeric',
            'imgdata' => ['required', 'string', 'regex:/^data:image\/png;base64,/']
        ],
        'cancel' => [
            'psw' => 'required|string'
        ],
        'second' => [
            'movie' => 'required|integer|between:0,4'
        ]
    ];
    public function handle($request, Closure $next, $option) {
        $validator = Validator::make($request->all(), self::$validList[$option]);
        if ($validator->fails()) {
            return response([
                'errno' => 200,
                'errmsg' => '数据格式存在错误。'
            ]);
        }
        return $next($request);
    }
}
