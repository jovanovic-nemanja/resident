<?php

namespace App\Http\Controllers\Admin;

use App\TFG;
use App\User;
use App\Reports;
use App\Adminlogs;
use App\Medications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TFGController extends Controller
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
        //
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indextfg($id)
    {
        $tfgs = TFG::where('resident', $id)->get();
        $user = User::where('id', $id)->first();

        return view('admin.tfgs.index', compact('tfgs', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createtfg($resident)
    {
        $result = [];

        $user = User::where('id', $resident)->first();
        if (@$user) {
            $result['user'] = $user;
        }

        if(auth()->user()->hasRole('clinicowner')) {
            $clinic_id = auth()->id();
        }else {
            $userid = auth()->id();
            $user = User::where('id', $userid)->first();
            $clinic_id = $user->clinic_id;
        }

        $result['medications'] = Medications::where('clinic_id', $clinic_id)->get();

        return view('admin.tfgs.create', compact('result'));
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
            'time' => 'required',
            'resident' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $time = User::formattime($request->time);

        $tfg = TFG::create([
            'medications' => $request->medications,
            'time' => $request->time,
            'resident' => $request->resident,
            'comment' => $request->comment,
            'file' => $request->file,
            'status' => 1,
            'sign_date' => $date,
        ]);

        TFG::upload_file($tfg->id);

        $medicationss = Medications::where('id', $request->medications)->first();
        if(@$medicationss) {
            $medicName = $medicationss->name;
        }else{
            $medicName = "";
        }

        $data = [];
        $data['caretakerId'] = auth()->id();
        $data['content'] = User::getUsernameById($data['caretakerId']) . " gave " . $medicName . "(" . $request->time . ")" . " to " . User::getUsernameById($request->resident);

        Adminlogs::Addlogs($data);

        $report = [];
        $report['user_id'] = auth()->id();
        $report['resident_id'] = $request->resident;
        $report['type'] = 4;  //1: primary activity, 2: secondary activity, 3: medication Routine, 4: PRN
        $report['medicationName'] = $medicName;
        $report['medicationTime'] = $time;

        if(auth()->user()->hasRole('clinicowner')) {
            $report['clinic_id'] = $report['user_id'];
        }else{
            $user_rec = User::where('id', $report['user_id'])->first();
            $report['clinic_id'] = $user_rec->clinic_id;
        }

        Reports::AddmedicationLogs($report);

        return redirect()->route('tfgs.indextfg', $request->resident)->with('flash', 'TFG has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = TFG::where('id', $id)->first();
        $result = [];
        $result['tfgs'] = $res;
        $result['user'] = User::where('id', $res->resident)->first();
        $result['medication'] = Medications::where('id', $res->medications)->first();
        $result['medications'] = Medications::all();

        return view('admin.tfgs.edit', compact('result'));
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
            'time' => 'required',
            'resident' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $time = $dates['time'];

        $record = TFG::where('id', $id)->first();
        if (@$record) {
            $record->medications = $request->medications;
            $record->time = $request->time;
            $record->resident = $request->resident;
            $record->comment = $request->comment;
            if (@$request->file) {
                $record->file = $request->file;
            }

            $record->update();

            if (@$request->file) {
                TFG::upload_file($record->id);
            }
        }

        return redirect()->route('tfgs.indextfg', $request->resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resident = TFG::where('id', $id)->first();
        $record = TFG::where('id', $id)->delete();
        
        return redirect()->route('tfgs.indextfg', $resident->resident);
    }
}
