<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\User;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\Storage;

class InjectCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel:inject {num}';

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
        echo "Injecting...\n";
        $startTime = microtime(true);

        $num = (Int)$this->argument('num');

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
            Storage::put('heart/' . $user->openid . '.png', '');
            $user->save();

        }

        $timeCost = microtime(true) - $startTime;
        echo "$num rows injected($timeCost sec)\n";
    }
}