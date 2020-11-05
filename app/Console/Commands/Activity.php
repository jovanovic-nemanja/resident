<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Activities;
use App\Notifications;
use App\Useractivities;
use App\ReminderConfigs;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyActivityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activitydaily:checkdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $cur_date = User::getformattime();
        $user_activities = DB::table('user_activities')
                            ->select('user_activities.*', 'activities.*', 'users.*', 'users.name as u_name', 'activities.type as act_type')
                            ->Join('activities', 'activities.id', '=', 'user_activities.activities')
                            ->Join('users', 'users.id', '=', 'user_activities.resident')
                            ->where('user_activities.type', 1)
                            ->get();

        if (@$user_activities) {
            foreach ($user_activities as $user_activity) {
                $cur_date['dates'] = Carbon::parse($cur_date['date']); 
                $activity_time = $user_activity->time;

                if (@$activity_time) {
                    $startTime = Carbon::parse(User::formattime1($activity_time));
                    $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
                    if ($startTime > $finishTime) {
                        $sym = "";
                    }else{
                        $sym = "-";
                    }
                    $totalDuration = $sym.$finishTime->diffInSeconds($startTime);
                }else {
                    $totalDuration = "";
                }

                $reminders = ReminderConfigs::where('active', 1)->first();
                $reminder_minutes = $reminders->minutes * 60;
                $activity_type_name = Activities::getTypeasstring($user_activity->act_type);

                if ($totalDuration == $reminder_minutes) {
                    $record = Notifications::create([
                        'user_name' => 'admin',
                        'resident_name' => $user_activity->u_name,
                        'contents' => "Daily " . $activity_type_name  . " : " . $user_activity->title . " " . $user_activity->time,
                        'is_read' => 1,
                        'sign_date' => $cur_date['date'],
                    ]);
                }
            }
        }
    }
}
