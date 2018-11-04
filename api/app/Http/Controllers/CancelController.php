<?php

namespace App\Http\Controllers;

use App\User;
use App\Match1;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CancelController extends Controller {
    public function __invoke(Request $req) {

        if (timeJudge() !== 2) {
            return [
                'errno' => 103,
                'errmsg' => '该时段不允许取消配对。'
            ];
        }
        
        $self = User::where('openid', $_SESSION['openid'])->first();
        $status = $self->match_status;
        if ($status <= 0) {
            return [
                'errno' => 401,
                'errmsg' => '目前没有被分配的对象，取消操作失败。'
            ];
        } else if ($status === 2) {
            return [
                'errno' => 104,
                'errmsg' => '取消机会只有一次，取消操作失败。'
            ];
        }

        $taId = Match1::where('self', $self->id)->first()->ta;
        $ta = User::where('id', $taId)->first();

        if ($ta->psw !== strtoupper($req->psw)) {
            return [
                'errno' => 105,
                'errmsg' => '密码错误'
            ];
        }

        $self->match_status = -1;
        $self->psw = generatePassword();
        $ta->match_status = -1;
        $ta->psw = generatePassword();

        DB::beginTransaction();
        if ($self->save() && $ta->save()) {
            DB::commit();
        } else {
            DB::rollback();
            return [
                'errno' => 502,
                'errmsg' => '数据库发生错误。'
            ];
        }

        return [
            'errno' => 0,
            'errmsg' => ''
        ];

    }
}