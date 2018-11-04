<?php

namespace App\Http\Controllers;

use App\User;
use App\Match1;
use App\Match2;

class QueryController extends Controller {
    public function __invoke() {

        $self = User::where('openid', $_SESSION['openid'])->first();
        $selfInfo = [
            'movie' => $self->movie,
            'psw' => $self->psw
        ];

        $status = $self->match_status;
        $timeJudge = timeJudge();
        if ($timeJudge < 2) {
            $matching = true;
        } else if ($timeJudge < 4
        && ($status === 2 || $status === -2)) {
            $matching = true;
        } else {
            $matching = false;
        }

        if ($status <= 0 || $matching) {
            $taInfo = null;
        } else {
            if ($status === 1) {
                $taId = Match1::where('self', $self->id)->first()->ta;
            } else if ($status === 2) {
                $taId = Match2::where('self', $self->id)->first()->ta;
            }
            $taInfo = User::select('name', 'age', 'grade', 'college', 'school', 'tel', 'wechat')
                ->where('id', $taId)
                ->first();
        }

        if ($matching) {
            $status_rtn = 2;
        } else if ($status <= 0) {
            $status_rtn = 1;
        } else {
            $status_rtn = 0;
        }

        return [
            'errno' => 0,
            'ermsg' => '',
            'status' => $status_rtn,
            'self' => $selfInfo,
            'ta' => $taInfo
        ];

    }
}