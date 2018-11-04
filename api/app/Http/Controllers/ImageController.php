<?php

namespace App\Http\Controllers;

use App\User;
use App\Match1;
use App\Match2;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller {

    public function self(Request $req) {
        return response(Storage::get('heart/' . $_SESSION['openid'] . '.png'))
        ->header('Content-type', 'image/png');
    }

    public function ta(Request $req) {

        $self = User::where('openid', $_SESSION['openid'])->first();

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
            return response(Storage::get('heart/0'))
            ->header('Content-type', 'image/png');
        } else {
            if ($status === 1) {
                $taId = Match1::where('self', $self->id)->first()->ta;
            } else if ($status === 2) {
                $taId = Match2::where('self', $self->id)->first()->ta;
            }
            $taOpenId = User::find($taId)->openid;
            return response(Storage::get('heart/' . $taOpenId . '.png'))
            ->header('Content-type', 'image/png');
        }
    }
}