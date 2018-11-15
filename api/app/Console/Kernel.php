<?php

namespace App\Console;

use App\User;
use App\Match1;
use App\Match2;
use Illuminate\Support\Facades\DB;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Match1Command::class,
        Commands\Match2Command::class,
        // Commands\InjectCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule) {
    //     $match1Time = date('i H j n *', env('TIME_START_FIRST_MATCH'));
    //     $match2Time = date('i H j n *', env('TIME_START_SECOND_MATCH'));

    //     $schedule->call(function () {
    //         $pos = 1;
    //         while (true) {
    
    //             $userA = User::where('id', '>=', $pos)
    //             ->where('match_status', 0)
    //             ->first();
    //             if (!$userA) {
    //                 break;
    //             }
                
    //             $pos = $userA->id + 1;
    
    //             $userAPointTop = 'point('
    //             . $userA->p_top->getLng() . ','
    //             . $userA->p_top->getLat() . ')';
    //             $userAPointRight = 'point('
    //             . $userA->p_right->getLng() . ','
    //             . $userA->p_right->getLat() . ')';
    //             $userATanTop = $userA->t_top;
    //             $userATanBottom = $userA->t_bottom;
    //             $userAHeightEndTop = $userA->h_end_top;
    
    //             $userB = User::select(DB::raw(
    //                 "id, match_status, (
    //                     st_distance(p_top, $userAPointTop)
    //                     + st_distance(p_right, $userAPointRight)
    //                     + abs(t_top - $userATanTop)
    //                     + abs(t_bottom - $userATanBottom)
    //                     + abs(h_end_top - $userAHeightEndTop) / 100
    //                 ) as distance"
    //             ))->where([
    //                 ['id', '>=', $pos],
    //                 ['match_status', 0],
    //                 ['gender', $userA->tagender],
    //                 ['tagender', $userA->gender],
    //                 ['movie', $userA->movie]
    //             ])->where(function ($query) use ($userA) {
    //                 $query->where('gender', $userA->gender)
    //                 ->orWhere(function ($query) use ($userA) {
    //                     $query->where('gender', '>', $userA->gender)
    //                     ->where('age', '>=', $userA->age);
    //                 })->orWhere(function ($query) use ($userA) {
    //                     $query->where('gender', '<', $userA->gender)
    //                     ->where('age', '<=', $userA->age);
    //                 });
    //             })->orderBy('distance', 'desc')
    //             ->orderBy('created_at', 'asc')
    //             ->first();
    
    //             if ($userB) {
    //                 $userA->match_status = 1;
    //                 $userA->save();
    //                 $userB->match_status = 1;
    //                 $userB->save();
    //                 Match1::insert([
    //                     ['self' => $userA->id, 'ta' => $userB->id],
    //                     ['self' => $userB->id, 'ta' => $userA->id]
    //                 ]);
    //             }
    
    //         }
    //     })->cron($match1Time);

    //     $schedule->call(function () {
    //         $pos = 0;
    //         while (true) {
                
    //             $userA = User::where('id', '>=', $pos)
    //             ->where('match_status', -2)
    //             ->first();
    //             if (!$userA) {
    //                 break;
    //             }
    
    //             $denyRecord = Match1::where('self', $userA->id)->first();
    //             $denyId = $denyRecord ? $denyRecord->ta : 0;
    
    //             $pos = $userA->id + 1;
                
    //             $userAPointTop = 'point('
    //             . $userA->p_top->getLng() . ','
    //             . $userA->p_top->getLat() . ')';
    //             $userAPointRight = 'point('
    //             . $userA->p_right->getLng() . ','
    //             . $userA->p_right->getLat() . ')';
    //             $userATanTop = $userA->t_top;
    //             $userATanBottom = $userA->t_bottom;
    //             $userAHeightEndTop = $userA->h_end_top;
    
    //             $userB = User::select(DB::raw(
    //                 "id, match_status, (
    //                     st_distance(p_top, $userAPointTop)
    //                     + st_distance(p_right, $userAPointRight)
    //                     + abs(t_top - $userATanTop)
    //                     + abs(t_bottom - $userATanBottom)
    //                     + abs(h_end_top - $userAHeightEndTop) / 100
    //                 ) as distance"
    //             ))->where([
    //                 ['id', '>=', $pos],
    //                 ['id', '<>', $denyId],
    //                 ['match_status', -2],
    //                 ['gender', $userA->tagender],
    //                 ['tagender', $userA->gender],
    //                 ['movie', $userA->movie]
    //             ])->where(function ($query) use ($userA) {
    //                 $query->where('gender', $userA->gender)
    //                 ->orWhere(function ($query) use ($userA) {
    //                     $query->where('gender', '>', $userA->gender)
    //                     ->where('age', '>=', $userA->age);
    //                 })->orWhere(function ($query) use ($userA) {
    //                     $query->where('gender', '<', $userA->gender)
    //                     ->where('age', '<=', $userA->age);
    //                 });
    //             })->orderBy('created_at', 'asc')
    //             ->first();
    
    //             if ($userB) {
    //                 $userA->match_status = 2;
    //                 $userA->save();
    //                 $userB->match_status = 2;
    //                 $userB->save();
    //                 Match2::insert([
    //                     ['self' => $userA->id, 'ta' => $userB->id],
    //                     ['self' => $userB->id, 'ta' => $userA->id]
    //                 ]);
    //             }
    
    //         }
    //     })->cron($match2Time);
        
    // }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
