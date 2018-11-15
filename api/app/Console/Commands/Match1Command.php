<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Match1;
use Illuminate\Support\Facades\DB;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class Match1Command extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:match1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pos = 1;
        $matchNum = 0;
        $timeStart = microtime(true);

        echo "The first match running...\n";

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
                $matchNum++;
                if ($matchNum % 50 === 0) {
                    echo "$matchNum couples generated\n";
                }
            }

        }

        $timeCost = microtime(true) - $timeStart;
        echo "=================================\n";
        echo "The first match completed!\n$matchNum couples totally generated!\nFinish within {$timeCost}sec.\n";
        echo "=================================\n";
    }
}