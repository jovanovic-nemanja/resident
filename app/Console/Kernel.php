<?php

namespace App\Console;

use Carbon\Carbon;
use App\Switchreminder;
use Illuminate\Support\Facades\DB;
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
        Commands\MedicationsCommand::class,
        Commands\DailyActivityCommand::class,
        Commands\WeeklyActivityCommand::class,
        Commands\MonthlyActivityCommand::class,
        'App\Console\Commands\DatabaseBackUp'
        // 'App\Console\Commands\DailyAssignMedications'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('database:backup')->daily();
        // $schedule->command('dailyassignmedications:duplicate')->daily();
        $userid = auth()->id();
        $enable = Switchreminder::where('clinic_id', $userid)->first();
        
        if (@$enable) { //disabled case
            # code...
        }else{  //enabled case
            $schedule->command('medications:checkdata')
                     ->everyMinute(); //Run the task every minute

            $schedule->command('activitydaily:checkdata')
                     ->everyMinute(); //Run the task every minute

            $schedule->command('activityweekly:checkdata')
                     ->everyMinute(); //Run the task every minute

            $schedule->command('activitymonthly:checkdata')
                     ->everyMinute(); //Run the task every minute
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
