<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\HealthCareCenters;
use App\HealthCareCenterTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HealtheCareCenterController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth', 'manager']);
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
    public function indexhealthcarecenter($resident)
    {
        $healthcarecenters = HealthCareCenters::where('user_id', $resident)->get();
        $user = User::where('id', $resident)->first();

        return view('admin.healthcarecenters.index', compact('healthcarecenters', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createhealthcarecenter($resident)
    {
        $user = User::where('id', $resident)->first();
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $types = HealthCareCenterTypes::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $types = HealthCareCenterTypes::where('clinic_id', $clinic_id)->get();

        }

        return view('admin.healthcarecenters.create', compact('types', 'user', 'resident'));
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
            'resident' => 'required',
            'health_care_center_type' => 'required',
            'firstname' => 'required|string|max:191',
            'email' => 'required|string|email|max:255',
            'zip_code' => 'required',
            'street1' => 'required|string|max:191',
            'city' => 'required'
        ]);
        
        DB::beginTransaction();

        $dates = User::getformattime();
        $date = $dates['date'];

        try {
            $healthcarecenter = HealthCareCenters::create([
                'firstname' => $request['firstname'],
                'email' => $request['email'],
                'zip_code' => $request['zip_code'],
                'user_id' => $request['resident'],
                'health_care_center_type' => $request['health_care_center_type'],
                'street1' => $request['street1'],
                'street2' => @$request['street2'],
                'city' => $request['city'],
                'phone' => $request['phone'],
                'fax' => $request['fax'],
                'sign_date' => $date,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('healthcarecenter.indexhealthcarecenter', $request['resident'])->with('flash', 'Successfully added new Health Care Center info.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $healthcarecenter = HealthCareCenters::where('id', $id)->first();
        $result = [];
        $result['healthcarecenter'] = $healthcarecenter;
        $result['user'] = User::where('id', $healthcarecenter->user_id)->first();
        
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $types = HealthCareCenterTypes::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $types = HealthCareCenterTypes::where('clinic_id', $clinic_id)->get();

        }
        $result['types'] = $types;

        return view('admin.healthcarecenters.edit', compact('result'));
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
            'health_care_center_type' => 'required',
            'firstname' => 'required|string|max:191',
            'email' => 'required|string|email|max:255',
            'zip_code' => 'required',
            'street1' => 'required|string|max:191',
            'city' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $time = $dates['time'];

        $record = HealthCareCenters::where('id', $id)->first();
        $resident = $record->user_id;
        if (@$record) {
            $record->health_care_center_type = $request->health_care_center_type;
            $record->firstname = $request->firstname;
            $record->email = $request->email;
            $record->zip_code = $request->zip_code;
            $record->street1 = $request->street1;
            $record->street2 = @$request->street2;
            $record->city = $request->city;
            $record->phone = @$request->phone;
            $record->fax = @$request->fax;

            $record->update();
        }

        return redirect()->route('healthcarecenter.indexhealthcarecenter', $resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rec = HealthCareCenters::where('id', $id)->first();
        $record = HealthCareCenters::where('id', $id)->delete();
        
        return redirect()->route('healthcarecenter.indexhealthcarecenter', $rec->user_id);
    }
}
