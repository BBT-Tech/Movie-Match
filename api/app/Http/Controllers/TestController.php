<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Match1;
use App\Match2;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller {
    public function inject(Request $request, $num) {
        
        for ($i = 0; $i < $num; $i++) {
            $user = new User;
            $user->fill([
                'gender' => mt_rand(0, 1),
                'name' => generatePassword(),
                'age' => mt_rand(16, 25),
                'grade' => mt_rand(1, 7),
                'college' => mt_rand(0, 9),
                'school' => generatePassword(),
                'tel' => mt_rand(100000, 199999) . mt_rand(10000, 99999),
                'wechat' => generatePassword(),
                'tagender' => mt_rand(0, 1),
                'movie' => mt_rand(0, 4)
            ]);
            $user->openid = generatePassword();
            $user->t_top =  atan(-mt_rand(1, mt_getrandmax()) / 10);
            $user->t_bottom = atan(-mt_rand(1, mt_getrandmax()) / 10);
            $user->h_end_top = mt_rand(100000, 120000) / 100000;
            $user->p_top = new Point(
                mt_rand(120000, 150000) / 100000,
                mt_rand(10000, 60000) / 100000
            );
            $user->p_right = new Point(
                mt_rand(60000, 130000) / 100000,
                mt_rand(50000, 90000) / 100000
            );
            $user->match_status = 0;
            $user->psw = generatePassword();
            Storage::put('heart/' . $user->openid . '.png', $img);
            $user->save();

        }
    }
    
    public function match1(Request $req) {
        $pos = 1;
        while (true) {

            $userA = User::where('id', '>=', $pos)
            ->where('match_status', 0)
            ->first();
            if (!$userA) {
                break;
            }
            
            $pos = $userA->id + 1;

            $userAPointTop = 'point('
            . $userA->p_top->getLng() . ','
            . $userA->p_top->getLat() . ')';
            $userAPointRight = 'point('
            . $userA->p_right->getLng() . ','
            . $userA->p_right->getLat() . ')';
            $userATanTop = $userA->t_top;
            $userATanBottom = $userA->t_bottom;
            $userAHeightEndTop = $userA->h_end_top;

            $userB = User::select(DB::raw(
                "id, match_status, (
                    st_distance(p_top, $userAPointTop)
                    + st_distance(p_right, $userAPointRight)
                    + abs(t_top - $userATanTop)
                    + abs(t_bottom - $userATanBottom)
                    + abs(h_end_top - $userAHeightEndTop) / 100
                ) as distance"
            ))->where([
                ['id', '>=', $pos],
                ['match_status', 0],
                ['gender', $userA->tagender],
                ['tagender', $userA->gender],
                ['movie', $userA->movie]
            ])->where(function ($query) use ($userA) {
                $query->where('gender', $userA->gender)
                ->orWhere(function ($query) use ($userA) {
                    $query->where('gender', '>', $userA->gender)
                    ->where('age', '>=', $userA->age);
                })->orWhere(function ($query) use ($userA) {
                    $query->where('gender', '<', $userA->gender)
                    ->where('age', '<=', $userA->age);
                });
            })->orderBy('distance', 'asc')
            ->orderBy('created_at', 'asc')
            ->first();

            if ($userB) {
                $userA->match_status = 1;
                $userA->save();
                $userB->match_status = 1;
                $userB->save();
                Match1::insert([
                    ['self' => $userA->id, 'ta' => $userB->id],
                    ['self' => $userB->id, 'ta' => $userA->id]
                ]);
            }

        }
    }

    public function match2(Request $req) {
        $pos = 0;
        while (true) {
            
            $userA = User::where('id', '>=', $pos)
            ->where('match_status', -2)
            ->first();
            if (!$userA) {
                break;
            }

            $denyRecord = Match1::where('self', $userA->id)->first();
            $denyId = $denyRecord ? $denyRecord->ta : 0;

            $pos = $userA->id + 1;
            
            $userAPointTop = 'point('
            . $userA->p_top->getLng() . ','
            . $userA->p_top->getLat() . ')';
            $userAPointRight = 'point('
            . $userA->p_right->getLng() . ','
            . $userA->p_right->getLat() . ')';
            $userATanTop = $userA->t_top;
            $userATanBottom = $userA->t_bottom;
            $userAHeightEndTop = $userA->h_end_top;

            $userB = User::select(DB::raw(
                "id, match_status, (
                    st_distance(p_top, $userAPointTop)
                    + st_distance(p_right, $userAPointRight)
                    + abs(t_top - $userATanTop)
                    + abs(t_bottom - $userATanBottom)
                    + abs(h_end_top - $userAHeightEndTop) / 100
                ) as distance"
            ))->where([
                ['id', '>=', $pos],
                ['id', '<>', $denyId],
                ['match_status', -2],
                ['gender', $userA->tagender],
                ['tagender', $userA->gender],
                ['movie', $userA->movie]
            ])->where(function ($query) use ($userA) {
                $query->where('gender', $userA->gender)
                ->orWhere(function ($query) use ($userA) {
                    $query->where('gender', '>', $userA->gender)
                    ->where('age', '>=', $userA->age);
                })->orWhere(function ($query) use ($userA) {
                    $query->where('gender', '<', $userA->gender)
                    ->where('age', '<=', $userA->age);
                });
            })->orderBy('distance', 'asc')
            ->orderBy('created_at', 'asc')
            ->first();

            if ($userB) {
                $userA->match_status = 2;
                $userA->save();
                $userB->match_status = 2;
                $userB->save();
                Match2::insert([
                    ['self' => $userA->id, 'ta' => $userB->id],
                    ['self' => $userB->id, 'ta' => $userA->id]
                ]);
            }

        }
    }

    public function match1Image(Request $req) {
        $couple = Match1::offset((int)$req->cou * 2)
        ->limit(1)
        ->first();
        if (!$couple) {
            return [
                'status' => 0
            ];
        }
        $userAId = $couple->self;
        // return $couple->self;

        $userA = User::find($userAId);
        if (!$userA) {
            return [
                'status' => 0
            ];
        }

        $pos = $couple->ta;

        $userAPointTop = 'point('
        . $userA->p_top->getLng() . ','
        . $userA->p_top->getLat() . ')';
        $userAPointRight = 'point('
        . $userA->p_right->getLng() . ','
        . $userA->p_right->getLat() . ')';
        $userATanTop = $userA->t_top;
        $userATanBottom = $userA->t_bottom;
        $userAHeightEndTop = $userA->h_end_top;

        $userB = User::select(DB::raw(
            "id, openid, gender, (
                st_distance(p_top, $userAPointTop)
                + st_distance(p_right, $userAPointRight)
                + abs(t_top - $userATanTop)
                + abs(t_bottom - $userATanBottom)
                + abs(h_end_top - $userAHeightEndTop) / 100
            ) as distance"
        ))->where([
            ['id', '>=', $pos],
            ['gender', $userA->tagender],
            ['tagender', $userA->gender],
            ['movie', $userA->movie]
        ])->where(function ($query) use ($userA) {
            $query->where('gender', $userA->gender)
            ->orWhere(function ($query) use ($userA) {
                $query->where('gender', '>', $userA->gender)
                ->where('age', '>=', $userA->age);
            })->orWhere(function ($query) use ($userA) {
                $query->where('gender', '<', $userA->gender)
                ->where('age', '<=', $userA->age);
            });
        })->orderBy('distance', 'asc')
        ->orderBy('created_at', 'asc')
        ->offset($req->can)
        ->limit(1)
        ->first();
        
        if ($userB) {
            $userAImg = base64_encode(Storage::get('heart/' . $userA->openid . '.png'));
            $userBImg = base64_encode(Storage::get('heart/' . $userB->openid . '.png'));
            return [
                'status' => 1,
                'id_l' => $userA->id,
                'id_r' => $userB->id,
                'gender_l' => $userA->gender,
                'gender_r' => $userB->gender,
                'img_l' => "data:image/png;base64,$userAImg",
                'img_r' => "data:image/png;base64,$userBImg",
            ];
        } else {
            return [
                'status' => 0
            ];
        }

    }
}