<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Role;
use App\Comments;
use App\RoleUser;
use App\Medications;
use App\Usermedications;
use App\AssignMedications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class MedicationsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'manager']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinic_id = auth()->id();
        $medications = Medications::where('clinic_id', $clinic_id)->get();

        return view('admin.medications.index', compact('medications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medications.create');
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
            'name' => 'required',
            'dose' => 'required'
            // 'photo' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        $medications = Medications::create([
            'name' => $request->name,
            'dose' => $request->dose,
            'photo' => @$request->photo,
            'clinic_id' => $clinic_id,
            'sign_date' => $date,
            'comments' => $request->comments
        ]);

        if (@$request->comments) {
            $arrs = explode(',', $request->comments);
            foreach ($arrs as $comm) {
                $comments = Comments::create([
                    'type' => 2,
                    'sign_date' => $date,
                    'name' => $comm,
                    'ref_id' => $medications['id']
                ]);
            }
        }

        if (@$request->photo) {
            Medications::upload_file($medications->id);
        }        

        return redirect()->route('medications.index')->with('flash', 'Medication has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Medications::where('id', $id)->first();

        return view('admin.medications.edit', compact('result'));
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
            'name' => 'required',
            'dose' => 'required',
            // 'photo' => 'required'
        ]);

        $record = Medications::where('id', $id)->first();
        if (@$record) {
            $record->name = $request->name;
            $record->dose = $request->dose;
            if (@$request->photo) {
                $record->photo = $request->photo;
            }
            $record->comments = $request->comments;

            $record->update();
        }

        $dates = User::getformattime();
        $date = $dates['date'];

        if (@$request->comments) {
            $arrs = explode(',', $request->comments);
            $del = Comments::where('type', 2)->where('ref_id', $record->id)->delete();
            foreach ($arrs as $comm) {
                $comments = Comments::create([
                    'type' => 2,
                    'name' => $comm,
                    'sign_date' => $date,
                    'ref_id' => $record->id
                ]);
            }
        }

        if (@$request->photo) {
            Medications::upload_file($record->id);
        }

        return redirect()->route('medications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignMeds = AssignMedications::where('medications', $id)->get();
        foreach ($assignMeds as $val) {
            $recc = Usermedications::where('assign_id', $val->id)->delete();
        }
        
        $assignMed = AssignMedications::where('medications', $id)->delete();
        $del = Comments::where('type', 2)->where('ref_id', $id)->delete();
        $record = Medications::where('id', $id)->delete();
        
        return redirect()->route('medications.index');
    }
}
