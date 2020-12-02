<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Comments;
use App\Adminlogs;
use App\Activities;
use App\Useractivities;
use App\Useractivityreports;

class UseractivitiesController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth', 'admin'])->except(['createuseractivity']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $useractivities = Useractivities::all();

        return view('admin.useractivities.index', compact('useractivities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.useractivities.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexuseractivity($id)
    {
        $useractivities = Useractivities::where('resident', $id)->orderBy('time')->get();
        $user = User::where('id', $id)->first();
        $comments = Comments::where('type', 1)->get();

        $arrs = [];
        $arrs = $useractivities;

        return view('admin.useractivities.index', compact('arrs', 'user', 'comments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexuseractivitygiven($id)
    {
        $useractivities = Useractivities::where('resident', $id)->orderBy('time')->get();
        $user = User::where('id', $id)->first();
        $comments = Comments::where('type', 1)->get();

        $arrs = [];
        $arrs = $useractivities;

        return view('admin.useractivities.indexgiven', compact('arrs', 'user', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createuseractivity($type, $resident)
    {
        $result = [];

        $result['type'] = $type;
        $user = User::where('id', $resident)->first();
        if (@$user) {
            $result['user'] = $user;
        }

        $result['activities'] = Activities::where('type', $type)->get();

        return view('admin.useractivities.create', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->weeks);print_r($request->months); exit();

        if (@$request->assign_id) {   //give activity as care taker
            $this->validate(request(), [
                'assign_id' => 'required',
                'resident' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];

            $assigned = Useractivities::where('id', $request->assign_id)->first();
            $time = $assigned->time;

            $reports = Useractivityreports::create([
                'assign_id' => $request->assign_id,
                'resident' => $request->resident,
                'comment' => $request->comment,
                'user' => auth()->id(),
                'sign_date' => $date,
            ]);

            $activities = Activities::where('id', $assigned->activities)->first();
            $actName = $activities->title;

            $data = [];
            $data['caretakerId'] = auth()->id();
            $data['content'] = User::getUsernameById($data['caretakerId']) . " gave " . $actName . "(" . $time . ")" . " to " . User::getUsernameById($request->resident);
            Adminlogs::Addlogs($data);

            return redirect()->route('useractivities.indexuseractivity', $request->resident)->with('flash', 'Activity has been successfully given.');
        }else{  //assign activity as admin
            $this->validate(request(), [
                'activities' => 'required',
                'type' => 'required',
                'resident' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];

            switch ($request->type) {
                case '1':   //daily
                    if (@$request->time1) {
                        $useractivities = Useractivities::create([
                            'activities' => $request->activities,
                            'time' => $request->time1,
                            'type' => $request->type,
                            'resident' => $request->resident,
                            'comment' => $request->comment,
                            'other_comment' => @$request->other_comment,
                            'file' => $request->file,
                            'status' => 1,
                            'sign_date' => $date,
                        ]);
                    }if (@$request->time2) {
                        $useractivities = Useractivities::create([
                            'activities' => $request->activities,
                            'time' => $request->time2,
                            'type' => $request->type,
                            'resident' => $request->resident,
                            'comment' => $request->comment,
                            'other_comment' => @$request->other_comment,
                            'file' => $request->file,
                            'status' => 1,
                            'sign_date' => $date,
                        ]);
                    }if (@$request->time3) {
                        $useractivities = Useractivities::create([
                            'activities' => $request->activities,
                            'time' => $request->time3,
                            'type' => $request->type,
                            'resident' => $request->resident,
                            'comment' => $request->comment,
                            'other_comment' => @$request->other_comment,
                            'file' => $request->file,
                            'status' => 1,
                            'sign_date' => $date,
                        ]);
                    }if (@$request->time4) {
                        $useractivities = Useractivities::create([
                            'activities' => $request->activities,
                            'time' => $request->time4,
                            'type' => $request->type,
                            'resident' => $request->resident,
                            'comment' => $request->comment,
                            'other_comment' => @$request->other_comment,
                            'file' => $request->file,
                            'status' => 1,
                            'sign_date' => $date,
                        ]);
                    }

                    break;
                case '2':   //weekly
                    if (@$request->weeks) {
                        $weeks = $request->weeks;
                        foreach ($weeks as $week) {
                            $useractivities = Useractivities::create([
                                'activities' => $request->activities,
                                'time' => $request->weekly_time,
                                'day' => $week,
                                'type' => $request->type,
                                'resident' => $request->resident,
                                'comment' => $request->comment,
                                'other_comment' => @$request->other_comment,
                                'file' => $request->file,
                                'status' => 1,
                                'sign_date' => $date,
                            ]);
                        }
                    }

                    break;
                case '3':   //monthly
                    if (@$request->months) {
                        $months = $request->months;
                        foreach ($months as $month) {
                            $useractivities = Useractivities::create([
                                'activities' => $request->activities,
                                'time' => $request->monthly_time,
                                'day' => $month,
                                'type' => $request->type,
                                'resident' => $request->resident,
                                'comment' => $request->comment,
                                'other_comment' => @$request->other_comment,
                                'file' => $request->file,
                                'status' => 1,
                                'sign_date' => $date,
                            ]);
                        }
                    }

                    break;                    
                default:
                    # code...
                    break;
            }

            // Useractivities::upload_file($useractivities->id);

            return redirect()->route('useractivities.indexuseractivity', $request->resident)->with('flash', 'Activity has been successfully created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = Useractivities::where('id', $id)->first();
        $result = [];
        $result['useractivities'] = $res;
        $result['user'] = User::where('id', $res->resident)->first();
        $result['activities'] = Activities::where('id', $res->activities)->get();
        $type = Activities::where('id', $res->activities)->first();
        $result['type'] = $type->type;
        $result['activity'] = $type;

        $activity = $res->activities;
        $result['comments'] = Comments::where('type', 1)->where('ref_id', $activity)->get();

        return view('admin.useractivities.edit', compact('result'));
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
        $this->validate(request(), [
            'activities' => 'required',
            'time' => 'required',
            'type' => 'required',
            'resident' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $time = $dates['time'];

        $record = Useractivities::where('id', $id)->first();
        if (@$record) {
            $record->activities = $request->activities;
            $record->time = $request->time;
            $record->type = $request->type;
            $record->day = $request->day;
            $record->resident = $request->resident;
            $record->comment = $request->comment;
            $record->other_comment = @$request->other_comment;
            $record->file = $request->file;

            $record->update();
        }

        Useractivities::upload_file($record->id);

        return redirect()->route('useractivities.indexuseractivity', $request->resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Useractivities::where('id', $id)->first();
        $reports = Useractivityreports::where('assign_id', $id)->delete();
        $record = Useractivities::where('id', $id)->delete();
        
        return redirect()->route('useractivities.indexuseractivity', $activity->resident);
    }
}
