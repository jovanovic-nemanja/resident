<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\User;
use Carbon\Carbon;
use App\Medications;
use App\Notifications;
use App\ReminderConfigs;
use App\Assignmedications;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getNotificationconfirmdata(Request $request)
    {
        $results = Notifications::where('is_read', 1)->get();

        return response()->json($results);
    }

    public function getNotificationdata(Request $request)
    {
        // $cur_date = User::getformattime();
        // $assign_medications = DB::table('assign_medications')
        //                     ->select('assign_medications.*', 'medications.*', 'assign_medications.sign_date as assign_date', 'users.*', 'medications.name as med_name', 'users.name as u_name')
        //                     ->Join('medications', 'medications.id', '=', 'assign_medications.medications')
        //                     ->Join('users', 'users.id', '=', 'assign_medications.resident')
        //                     ->get();

        // if (@$assign_medications) {
        //     foreach ($assign_medications as $assign_medication) {
        //         $ass_date = Carbon::parse($assign_medication->assign_date);
        //         $cur_date['dates'] = Carbon::parse($cur_date['date']); 

        //         if ($ass_date->addDays($assign_medication->duration) >= $cur_date['dates']) {   
        //             $assign_time1 = $assign_medication->time1;
        //             if ($assign_time1) {
        //                 $startTime = Carbon::parse(User::formattime1($assign_time1));
        //                 $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
        //                 if ($startTime > $finishTime) {
        //                     $sym = "";
        //                 }else{
        //                     $sym = "-";
        //                 }
        //                 $totalDuration1 = $sym.$finishTime->diffInSeconds($startTime);
        //             }else {
        //                 $totalDuration1 = "";
        //             }

        //             $assign_time2 = $assign_medication->time2;
        //             if ($assign_time2) {
        //                 $startTime = Carbon::parse(User::formattime1($assign_time2));
        //                 $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
        //                 if ($startTime > $finishTime) {
        //                     $sym = "";
        //                 }else{
        //                     $sym = "-";
        //                 }
        //                 $totalDuration2 = $sym.$finishTime->diffInSeconds($startTime);
        //             }else {
        //                 $totalDuration2 = "";
        //             }

        //             $assign_time3 = $assign_medication->time3;
        //             if ($assign_time3) {
        //                 $startTime = Carbon::parse(User::formattime1($assign_time3));
        //                 $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
        //                 if ($startTime > $finishTime) {
        //                     $sym = "";
        //                 }else{
        //                     $sym = "-";
        //                 }
        //                 $totalDuration3 = $sym.$finishTime->diffInSeconds($startTime);
        //             }else {
        //                 $totalDuration3 = "";
        //             }

        //             $assign_time4 = $assign_medication->time4;
        //             if ($assign_time4) {
        //                 $startTime = Carbon::parse(User::formattime1($assign_time4));
        //                 $finishTime = Carbon::parse(User::formattime1($cur_date['time']));
        //                 if ($startTime > $finishTime) {
        //                     $sym = "";
        //                 }else{
        //                     $sym = "-";
        //                 }
        //                 $totalDuration4 = $sym.$finishTime->diffInSeconds($startTime);
        //             }else {
        //                 $totalDuration4 = "";
        //             }

        //             $reminders = ReminderConfigs::where('active', 1)->first();
        //             $reminder_minutes = $reminders->minutes * 60;

        //             if ($totalDuration1 == $reminder_minutes || $totalDuration2 == $reminder_minutes || $totalDuration3 == $reminder_minutes || $totalDuration4 == $reminder_minutes) {
        //                 $record = Notifications::create([
        //                     'user_name' => 'admin',
        //                     'resident_name' => $assign_medication->u_name,
        //                     'contents' => $assign_medication->med_name,
        //                     'is_read' => 1,
        //                     'sign_date' => $cur_date['date'],
        //                 ]);
        //             }
        //         }
        //     }
        // }

        $results = Notifications::where('is_read', 1)->get();

        return response()->json($results);
    }

    public function updateIsread(Request $request)
    {
        $dates = User::getformattime();
        $date = $dates['date'];
        $time = $dates['time'];

        if (@$request->notificationId) {
            $record = Notifications::where('id', $request->notificationId)->first();
            $record->is_read = 2;
            $record->update();
        }

        return response()->json("status", 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
