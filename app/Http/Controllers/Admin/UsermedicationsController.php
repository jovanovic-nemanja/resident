<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\User;
use App\Routes;
use App\Adminlogs;
use App\Comments;
use App\Medications;
use App\Usermedications;
use App\Assignmedications;

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
        $assignmedications = Assignmedications::all();

        return view('admin.usermedications.index', compact('usermedications', 'assignmedications'));
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
        $usermedications = Usermedications::where('resident', $id)->orderBy('sign_date', 'asc')->get();
        $assignmedications = Assignmedications::where('resident', $id)->orderBy('sign_date', 'desc')->get();
        $arrs = [];

        if (@$assignmedications) {
            foreach ($assignmedications as $assignmedication) {
                if (@$assignmedication->time1) {
                    $arrs[] = array(
                        'id' => $assignmedication->id,
                        'sign_date' => $assignmedication->sign_date,
                        'dose' => $assignmedication->dose,
                        'route' => $assignmedication->route,
                        'time' => $assignmedication->time1,
                        'type' => 1
                    );
                } if (@$assignmedication->time2) {
                    $arrs[] = array(
                        'id' => $assignmedication->id,
                        'sign_date' => $assignmedication->sign_date,
                        'dose' => $assignmedication->dose,
                        'route' => $assignmedication->route,
                        'time' => $assignmedication->time2,
                        'type' => 2
                    );
                } if (@$assignmedication->time3) {
                    $arrs[] = array(
                        'id' => $assignmedication->id,
                        'sign_date' => $assignmedication->sign_date,
                        'dose' => $assignmedication->dose,
                        'route' => $assignmedication->route,
                        'time' => $assignmedication->time3,
                        'type' => 3
                    );
                } if (@$assignmedication->time4) {
                    $arrs[] = array(
                        'id' => $assignmedication->id,
                        'sign_date' => $assignmedication->sign_date,
                        'dose' => $assignmedication->dose,
                        'route' => $assignmedication->route,
                        'time' => $assignmedication->time4,
                        'type' => 4
                    );
                }                  
            }
        }

        usort($arrs, function($a, $b) {
            return strtotime($a['time']) - strtotime($b['time']);
        });

        $user = User::where('id', $id)->first();

        $comments = Comments::where('type', 2)->get();

        return view('admin.usermedications.index', compact('usermedications', 'user', 'arrs', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createusermedication($resident, $assign_id, $medication_id)
    {
        $result = [];

        $user = User::where('id', $resident)->first();
        if (@$user) {
            $result['user'] = $user;
        }

        $result['medications'] = Medications::all();
        $result['assigns'] = Assignmedications::where('id', $assign_id)->first();
        $result['assign_id'] = $assign_id;
        $result['medication_id'] = $medication_id;
        $result['medication'] = Medications::where('id', $medication_id)->first();

        return view('admin.usermedications.create', compact('result'));
    }

    public function getCurrentTimeByAjax(Request $request)
    {
        $date = date('y-m-d h:i:s');
        $current = User::formattime($date);
        return response()->json($current);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createassignmedication($resident)
    {
        $result = [];

        $user = User::where('id', $resident)->first();
        if (@$user) {
            $result['user'] = $user;
        }

        $result['medications'] = Medications::all();

        $result['routes'] = Routes::all();

        return view('admin.usermedications.createassign', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (@$request->assign) {    //assign medication for admin
            $this->validate(request(), [
                'medications' => 'required',
                'dose' => 'required',
                'resident' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];

            $assignmedications = Assignmedications::create([
                'medications' => $request->medications,
                'dose' => $request->dose,
                'resident' => $request->resident,
                'route' => $request->route,
                'sign_date' => $date,
                'time1' => @$request->time1,
                'time2' => @$request->time2,
                'time3' => @$request->time3,
                'time4' => @$request->time4,
            ]);

            return redirect()->route('usermedications.indexusermedication', $request->resident)->with('flash', 'Medication has been successfully assigned.');
        }else{  //give medication for care taker
            $this->validate(request(), [
                'assign_id' => 'required',
                'resident' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];

            $assigned = Assignmedications::where('id', $request->assign_id)->first();
            if ($request->type == 1) {
                $time = $assigned->time1;
                $assigned->time1 = NULL;    
            }if ($request->type == 2) {
                $time = $assigned->time2;
                $assigned->time2 = NULL;    
            }if ($request->type == 3) {
                $time = $assigned->time3;
                $assigned->time3 = NULL;    
            }if ($request->type == 4) {
                $time = $assigned->time4;
                $assigned->time4 = NULL;    
            }
            
            $assigned->update();

            $usermedications = Usermedications::create([
                'assign_id' => $request->assign_id,
                'resident' => $request->resident,
                'comment' => $request->comment,
                'user' => auth()->id(),
                'sign_date' => $date,
            ]);

            $medicationss = Medications::where('id', $assigned->medications)->first();
            $medicName = $medicationss->name;

            $data = [];
            $data['caretakerId'] = auth()->id();
            $data['content'] = User::getUsernameById($data['caretakerId']) . " gave " . $medicName . "(" . $time . ")" . " to " . User::getUsernameById($request->resident);
            Adminlogs::Addlogs($data);

            return redirect()->route('usermedications.indexusermedication', $request->resident)->with('flash', 'Medication has been successfully given.');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showassign($id)
    {
        $res = Assignmedications::where('id', $id)->first();
        $result = [];
        $result['usermedications'] = $res;
        $result['user'] = User::where('id', $res->resident)->first();
        $result['medications'] = Medications::where('id', $res->medications)->get();
        $result['medication'] = Medications::where('id', $res->medications)->first();
        $result['allmedications'] = Medications::all();

        $comment = $res->medications;
        $result['routes'] = Routes::all();

        return view('admin.usermedications.editassign', compact('result'));
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
        if (@$request->assign) {
            $this->validate(request(), [
                'medications' => 'required',
                'dose' => 'required',
                'resident' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];
            $time = $dates['time'];

            $record = Assignmedications::where('id', $id)->first();
            if (@$record) {
                $record->medications = $request->medications;
                $record->dose = $request->dose;
                $record->resident = $request->resident;
                $record->route = $request->route;
                $record->time1 = @$request->time1;
                $record->time2 = @$request->time2;
                $record->time3 = @$request->time3;
                $record->time4 = @$request->time4;

                $record->update();
            }
        }else {
            $this->validate(request(), [
                'medications' => 'required',
                'dose' => 'required',
                'resident' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];
            $time = $dates['time'];

            $record = Usermedications::where('id', $id)->first();
            if (@$record) {
                $record->medications = $request->medications;
                $record->dose = $request->dose;
                $record->resident = $request->resident;
                $record->comment = $request->comment;
                $record->file = $request->file;

                $record->update();
            }

            Usermedications::upload_file($record->id);
        }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyassign($id)
    {
        $medication = Assignmedications::where('id', $id)->first();
        $assigned = Usermedications::where('assign_id', $id)->delete();
        $record = Assignmedications::where('id', $id)->delete();
        
        return redirect()->route('usermedications.indexusermedication', $medication->resident);
    }
}
