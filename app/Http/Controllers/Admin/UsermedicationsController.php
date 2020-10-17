<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Medications;
use App\Usermedications;

class UsermedicationsController extends Controller
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
        $usermedications = Usermedications::all();

        return view('admin.usermedications.index', compact('usermedications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usermedications.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexusermedication($id)
    {
        $usermedications = Usermedications::where('resident', $id)->get();
        $user = User::where('id', $id)->first();

        return view('admin.usermedications.index', compact('usermedications', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createusermedication($resident)
    {
        $result = [];

        $user = User::where('id', $resident)->first();
        if (@$user) {
            $result['user'] = $user;
        }

        $result['medications'] = Medications::all();

        return view('admin.usermedications.create', compact('result'));
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
            'medications' => 'required',
            'daily_count' => 'required',
            'duration' => 'required',
            'resident' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];

        $usermedications = Usermedications::create([
            'medications' => $request->medications,
            'daily_count' => $request->daily_count,
            'duration' => $request->duration,
            'resident' => $request->resident,
            'comment' => $request->comment,
            'file' => $request->file,
            'status' => 1,
            'sign_date' => $date,
        ]);

        Usermedications::upload_file($usermedications->id);

        return redirect()->route('usermedications.indexusermedication', $request->resident)->with('flash', 'Medication has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = Usermedications::where('id', $id)->first();
        $result = [];
        $result['usermedications'] = $res;
        $result['user'] = User::where('id', $res->resident)->first();
        $result['medications'] = Medications::where('id', $res->medications)->get();
        $result['medication'] = Medications::where('id', $res->medications)->first();
        $result['allmedications'] = Medications::all();

        return view('admin.usermedications.edit', compact('result'));
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
            'medications' => 'required',
            'daily_count' => 'required',
            'duration' => 'required',
            'resident' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $time = $dates['time'];

        $record = Usermedications::where('id', $id)->first();
        if (@$record) {
            $record->medications = $request->medications;
            $record->daily_count = $request->daily_count;
            $record->duration = $request->duration;
            $record->resident = $request->resident;
            $record->comment = $request->comment;
            $record->file = $request->file;

            $record->update();
        }

        Usermedications::upload_file($record->id);

        return redirect()->route('usermedications.indexusermedication', $request->resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medication = Usermedications::where('id', $id)->first();
        $record = Usermedications::where('id', $id)->delete();
        
        return redirect()->route('usermedications.indexusermedication', $medication->resident);
    }

    public function assign($id)
    {
        if (@$id) {
            $record = Usermedications::where('id', $id)->first();
            if (@$record) {
                $record->status = 2;

                $record->update();
            }

            return redirect()->route('usermedications.indexusermedication', $record->resident);
        }
    }
}
