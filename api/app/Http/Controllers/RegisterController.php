<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller {

    public function first(Request $req) {

        if (timeJudge() !== 0) {
            return [
                'error' => 400,
                'errmsg' => '该时段不能提交个人信息。'
            ];
        }

        if (User::where('openid', $_SESSION['openid'])->count()) {
            return [
                'errno' => 300,
                'errmsg' => '你已提交个人信息，请勿重复提交。'
            ];
        }

        // 保存图片
        $img = substr($req->imgdata, 22);
        $img = base64_decode($img);
        try {
            $imgInfo = getimagesizefromstring($img);
            if ($imgInfo['mime'] !== 'image/png') {
                throw new \Exception;
            }
        } catch (\Exception $e) {
            return [
                'errno' => 201,
                'errcode' => '数据格式存在错误。'
            ];
        }
        Storage::put('heart/' . $_SESSION['openid'] . '.png', $img);
        
        $user = new User;
        $user->fill($req->all());
        $user->openid = $_SESSION['openid'];
        $user->t_top = $req->points['t_top'];
        $user->t_bottom = $req->points['t_bottom'];
        $user->h_end_top = $req->points['h_end_top'];
        $user->p_top = new Point($req->points['p_top']['y'], $req->points['p_top']['x']);
        $user->p_right = new Point($req->points['p_right']['y'], $req->points['p_right']['x']);
        $user->match_status = 0;
        $user->psw = generatePassword();
        if (!$user->save()) {
            return [
                'errno' => 501,
                'errmsg' => '数据库发生错误'
            ];
        }
        
        return [
            'errno' => 0,
            'errmsg' => ''
        ];

    }

    public function second(Request $req) {

        if (timeJudge() !== 2) {
            return [
                'errno' => 106,
                'errmsg' => '该时段不能为第二次匹配作信息修改。'
            ];
        }

        $self = User::where('openid', $_SESSION['openid'])->first();
        $status = $self->match_status;
        if ($status === 1) {
            return [
                'errno' => 107,
                'errmsg' => '第一次配对未被取消，修改失败。'
            ];
        }
        if ($status === -2) {
            return [
                'errno' => 108,
                'errmsg' => '只能作一次修改。'
            ];
        }

        $self->movie = $req->movie;
        $self->match_status = -2;
        if (!$self->save()) {
            return [
                'errno' => 503,
                'errmsg' => '数据库发生错误。'
            ];
        }

        return [
            'errno' => 0,
            'errmsg' => ''
        ];

    }

}