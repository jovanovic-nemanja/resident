<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Adminlogs;
use App\Comments;
use App\Activities;
use App\Useractivities;

class UseractivitiesController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth', 'admin']);
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

        return view('admin.useractivities.index', compact('useractivities', 'user'));
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
        $this->validate(request(), [
            'activities' => 'required',
            'type' => 'required',
            'resident' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];

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

        // Useractivities::upload_file($useractivities->id);

        return redirect()->route('useractivities.indexuseractivity', $request->resident)->with('flash', 'Activity has been successfully created.');
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
        $resident = Useractivities::where('id', $id)->first();
        $record = Useractivities::where('id', $id)->delete();
        
        return redirect()->route('useractivities.indexuseractivity', $resident->resident);
    }
}
