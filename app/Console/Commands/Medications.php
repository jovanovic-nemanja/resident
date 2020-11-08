<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Medications;
use App\Notifications;
use App\ReminderConfigs;
use App\Assignmedications;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MedicationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medications:checkdata';

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
        $assign_medications = DB::table('assign_medications')
                            ->select('assign_medications.*', 'medications.*', 'assign_medications.sign_date as assign_date', 'users.*', 'medications.name as med_name', 'users.name as u_name')
                            ->Join('medications', 'medications.id', '=', 'assign_medications.medications')
                            ->Join('users', 'users.id', '=', 'assign_medications.resident')
                            ->get();

        if (@$assign_medications) {
            foreach ($assign_medications as $assign_medication) {
                $ass_date = Carbon::parse($assign_medication->assign_date);
                $cur_date['dates'] = Carbon::parse($cur_date['date']); 

                // if ($ass_date->addDays($assign_medication->duration) >= $cur_date['dates']) {   
                    $assign_time1 = $assign_medication->time1;
                    if ($assign_time1) {
                        $startTime = Carbon::parse(User::formattime1($assign_time1));
                        $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
                        if ($startTime > $finishTime) {
                            $sym = "";
                        }else{
                            $sym = "-";
                        }
                        $totalDuration1 = $sym.$finishTime->diffInSeconds($startTime);
                    }else {
                        $totalDuration1 = "";
                    }

                    $assign_time2 = $assign_medication->time2;
                    if ($assign_time2) {
                        $startTime = Carbon::parse(User::formattime1($assign_time2));
                        $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
                        if ($startTime > $finishTime) {
                            $sym = "";
                        }else{
                            $sym = "-";
                        }
                        $totalDuration2 = $sym.$finishTime->diffInSeconds($startTime);
                    }else {
                        $totalDuration2 = "";
                    }

                    $assign_time3 = $assign_medication->time3;
                    if ($assign_time3) {
                        $startTime = Carbon::parse(User::formattime1($assign_time3));
                        $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
                        if ($startTime > $finishTime) {
                            $sym = "";
                        }else{
                            $sym = "-";
                        }
                        $totalDuration3 = $sym.$finishTime->diffInSeconds($startTime);
                    }else {
                        $totalDuration3 = "";
                    }

                    $assign_time4 = $assign_medication->time4;
                    if ($assign_time4) {
                        $startTime = Carbon::parse(User::formattime1($assign_time4));
                        $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
                        if ($startTime > $finishTime) {
                            $sym = "";
                        }else{
                            $sym = "-";
                        }
                        $totalDuration4 = $sym.$finishTime->diffInSeconds($startTime);
                    }else {
                        $totalDuration4 = "";
                    }

                    $reminders = ReminderConfigs::where('active', 1)->first();
                    $reminder_minutes = $reminders->minutes * 60;

                    if ($totalDuration1 == $reminder_minutes) {
                        $record = Notifications::create([
                            'user_name' => 'admin',
                            'resident_name' => $assign_medication->u_name,
                            'contents' => "Medication : " . $assign_medication->med_name . " " . $assign_medication->time1,
                            'is_read' => 1,
                            'sign_date' => $cur_date['date'],
                        ]);
                    } if ($totalDuration2 == $reminder_minutes) {
                        $record = Notifications::create([
                            'user_name' => 'admin',
                            'resident_name' => $assign_medication->u_name,
                            'contents' => "Medication : " . $assign_medication->med_name . " " . $assign_medication->time2,
                            'is_read' => 1,
                            'sign_date' => $cur_date['date'],
                        ]);
                    } if ($totalDuration3 == $reminder_minutes) {
                        $record = Notifications::create([
                            'user_name' => 'admin',
                            'resident_name' => $assign_medication->u_name,
                            'contents' => "Medication : " . $assign_medication->med_name . " " . $assign_medication->time3,
                            'is_read' => 1,
                            'sign_date' => $cur_date['date'],
                        ]);
                    } if ($totalDuration4 == $reminder_minutes) {
                        $record = Notifications::create([
                            'user_name' => 'admin',
                            'resident_name' => $assign_medication->u_name,
                            'contents' => "Medication : " . $assign_medication->med_name . " " . $assign_medication->time4,
                            'is_read' => 1,
                            'sign_date' => $cur_date['date'],
                        ]);
                    }
                // }
            }
        }
    }
}
