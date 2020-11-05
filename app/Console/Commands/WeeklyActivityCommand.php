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

class WeeklyActivityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activityweekly:checkdata';

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
                            ->where('user_activities.type', 2)
                            ->get();

        if (@$user_activities) {
            foreach ($user_activities as $user_activity) {
                $activity_type_name = Activities::getTypeasstring($user_activity->act_type);

                $record = Notifications::create([
                    'user_name' => 'admin',
                    'resident_name' => $user_activity->u_name,
                    'contents' => "Weekly " . $activity_type_name  . " : " . $user_activity->title,
                    'is_read' => 1,
                    'sign_date' => $cur_date['date'],
                ]);
            }
        }
    }
}
