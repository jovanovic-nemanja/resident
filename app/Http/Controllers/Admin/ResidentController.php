<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Assignmedications;
use App\Usermedications;
use App\Useractivities;
use App\Resident_information;
use App\Useractivityreports;
use App\TFG;
use App\Bodyharms;
use App\RoleUser;
use App\Vitalsign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ResidentController extends Controller
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
        return view('admin.resident.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function management()
    {
        $residents = User::all();

        return view('admin.resident.index', compact('residents'));
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
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required|string',
            'phone_number' => 'string|max:20',
            'profile_logo'      => 'required',
        ]);
        
        $request['gender'] == "male" ? $request['gender'] = 0 : $request['gender'] = 1;

        DB::beginTransaction();

        $dates = User::getformattime();
        $date = $dates['date'];

        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'profile_logo' => $request['profile_logo'],
                'gender' => $request['gender'],
                'birthday' => $request['birthday'],
                'address' => $request['address'],
                'password' => '',
                'phone_number' => $request['phone_number'],
                'sign_date' => $date,
            ]);

            User::upload_logo_img($user->id);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 3,
            ]);

            $resident_information = Resident_information::create([
                'date_admitted' => @$request['date_admitted'],
                'ssn' => @$request['ssn'],
                'primary_language' => @$request['primary_language'],
                'representing_party_name' => @$request['representing_party_name'],
                'representing_party_address' => @$request['representing_party_address'],
                'representing_party_home_phone' => @$request['representing_party_home_phone'],
                'representing_party_cell_phone' => @$request['representing_party_cell_phone'],
                'secondary_representative_name' => @$request['secondary_representative_name'],
                'secondary_representative_address' => @$request['secondary_representative_address'],
                'secondary_representative_home_phone' => @$request['secondary_representative_home_phone'],
                'secondary_representative_cell_phone' => @$request['secondary_representative_cell_phone'],
                'physician_or_medical_group_name' => @$request['physician_or_medical_group_name'],
                'physician_or_medical_group_address' => @$request['physician_or_medical_group_address'],
                'physician_or_medical_group_phone' => @$request['physician_or_medical_group_phone'],
                'physician_or_medical_group_fax' => @$request['physician_or_medical_group_fax'],
                'pharmacy_name' => @$request['pharmacy_name'],
                'pharmacy_address' => @$request['pharmacy_address'],
                'pharmacy_home_phone' => @$request['pharmacy_home_phone'],
                'pharmacy_fax' => @$request['pharmacy_fax'],
                'dentist_name' => @$request['dentist_name'],
                'dentist_address' => @$request['dentist_address'],
                'dentist_home_phone' => @$request['dentist_home_phone'],
                'dentist_fax' => @$request['dentist_fax'],
                'advance_directive' => @$request['advance_directive'],
                'polst' => @$request['polst'],
                'alergies' => @$request['alergies'],
                'signDate' => $date
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('home')->with('flash', 'Successfully added new Resident.');
    }

    /**
     * Display the Incidence Body harm page.
     *
     * @param  int  $id userid
     * @return \Illuminate\Http\Response
     */
    public function bodyharm()
    {
        return view('frontend.webgl');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        
        $vitalsign = [];
        $vitalsign['temperature'] = Vitalsign::where('resident_id', $id)->where('type', 1)->latest()->first();
        $vitalsign['blood_pressure'] = Vitalsign::where('resident_id', $id)->where('type', 2)->latest()->first();
        $vitalsign['heart_rate'] = Vitalsign::where('resident_id', $id)->where('type', 3)->latest()->first();

        return view('admin.resident.viewuser', compact('user', 'vitalsign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resident = User::where('id', $id)->first();

        return view('admin.resident.edit', compact('resident'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required|string',
            'phone_number' => 'string|max:20',
            'profile_logo'      => 'required',
        ]);

        $record = User::where('id', $id)->first();
        if (@$record) {
            $record->name = $request->name;
            $record->email = $request->email;
            $record->gender = $request->gender;
            $record->address = $request->address;
            $record->birthday = $request->birthday;
            $record->phone_number = $request->phone_number;
            if (@$request->profile_logo) {
                $record->profile_logo = $request->profile_logo;
            }
            $record->update();
        }
        
        if (@$request->profile_logo) {
            User::upload_logo_img($record->id);
        }

        return redirect()->route('resident.management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete resident activity reports
        $activityreports = Useractivityreports::where('resident', $id)->delete();
        
        // delete resident activities
        $activityreports = Useractivities::where('resident', $id)->delete();

        // delete resident medications reports
        $activityreports = Usermedications::where('resident', $id)->delete();

        // delete resident medication 
        $activityreports = Assignmedications::where('resident', $id)->delete();

        // delete resident tfgs 
        $activityreports = TFG::where('resident', $id)->delete();

        // delete resident body harms 
        $activityreports = Bodyharms::where('resident', $id)->delete();

        // delete resident vital sign 
        $activityreports = Vitalsign::where('resident_id', $id)->delete();

        $record = User::where('id', $id)->delete();

        $roleuser = RoleUser::where('user_id', $id)->delete();
        
        return redirect()->route('resident.management');
    }
}
