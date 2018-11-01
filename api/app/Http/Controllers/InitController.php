<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InitController extends Controller {
    public function __invoke(Request $req) {
        if (isset($_SESSION['openid'])) {
            return [
                'errno' => 0,
                'errmsg' => '',
                'status' => timeJudge(),
                'login' => true,
                'reg' => DB::table('users')->where('openid', $_SESSION['openid'])->exists()
            ];
        }
        return [
            'errno' => 0,
            'errmsg' => '',
            'status' => timeJudge(),
            'login' => false,
            'reg' => false
        ];
    }
}