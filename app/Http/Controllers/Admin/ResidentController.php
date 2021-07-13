<?php

namespace App\Http\Controllers\Admin;

use App\Poas;
use App\Tabs;
use App\User;
use App\Role;
use App\Assignmedications;
use App\Usermedications;
use App\Useractivities;
use App\Resident_information;
use App\Useractivityreports;
use App\Physician;
use App\Pharmacys;
use App\Dentists;
use App\TFG;
use App\Bodyharms;
use App\RoleUser;
use App\Vitalsign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
{
    
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting_tabs = Tabs::all();
        $fields = DB::table('setting_tabs')
                    ->leftJoin('groups', 'groups.tabId', '=', 'setting_tabs.id')
                    ->leftJoin('fields', 'fields.group_id', '=', 'groups.id')
                    // ->leftJoin('field_types', 'field_types.fieldID', '=', 'fields.id')
                    ->select('fields.*', 'groups.tabId')
                    ->get();

        return view('admin.resident.create', compact('setting_tabs', 'fields'));
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required',
            'birthday' => 'required|date',
            'street1' => 'required|string',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'phone_number' => 'string|max:20',
            'profile_logo'      => 'required',
        ]);
        
        ($request['gender'] == "male") ? $request['gender'] = 0 : $request['gender'] = 1;

        DB::beginTransaction();

        $dates = User::getformattime();
        $date = $dates['date'];

        try {
            $user = User::create([
                'firstname' => $request['firstname'],
                'middlename' => @$request['middlename'],
                'lastname' => $request['lastname'],
                'email' => $request['email'],
                'profile_logo' => $request['profile_logo'],
                'gender' => $request['gender'],
                'birthday' => $request['birthday'],
                'street1' => $request['street1'],
                'street2' => @$request['street2'],
                'city' => $request['city'],
                'zip_code' => $request['zip_code'],
                'state' => $request['state'],
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
                'representing_party_firstname' => @$request['representing_party_firstname'],
                'representing_party_lastname' => @$request['representing_party_lastname'],
                'representing_party_street1' => @$request['representing_party_street1'],
                'representing_party_street2' => @$request['representing_party_street2'],
                'representing_party_city' => @$request['representing_party_city'],
                'representing_party_zip_code' => @$request['representing_party_zip_code'],
                'representing_party_state' => @$request['representing_party_state'],
                'representing_party_home_phone' => @$request['representing_party_home_phone'],
                'representing_party_cell_phone' => @$request['representing_party_cell_phone'],

                'secondary_representative_firstname' => @$request['secondary_representative_firstname'],
                'secondary_representative_lastname' => @$request['secondary_representative_lastname'],
                'secondary_representative_street1' => @$request['secondary_representative_street1'],
                'secondary_representative_street2' => @$request['secondary_representative_street2'],
                'secondary_representative_city' => @$request['secondary_representative_city'],
                'secondary_representative_zip_code' => @$request['secondary_representative_zip_code'],
                'secondary_representative_state' => @$request['secondary_representative_state'],
                'secondary_representative_home_phone' => @$request['secondary_representative_home_phone'],
                'secondary_representative_cell_phone' => @$request['secondary_representative_cell_phone'],

                'physician_or_medical_group_firstname' => @$request['physician_or_medical_group_firstname'],
                'physician_or_medical_group_lastname' => @$request['physician_or_medical_group_lastname'],
                'physician_or_medical_group_street1' => @$request['physician_or_medical_group_street1'],
                'physician_or_medical_group_street2' => @$request['physician_or_medical_group_street2'],
                'physician_or_medical_group_city' => @$request['physician_or_medical_group_city'],
                'physician_or_medical_group_zip_code' => @$request['physician_or_medical_group_zip_code'],
                'physician_or_medical_group_state' => @$request['physician_or_medical_group_state'],
                'physician_or_medical_group_phone' => @$request['physician_or_medical_group_phone'],
                'physician_or_medical_group_fax' => @$request['physician_or_medical_group_fax'],

                'pharmacy_firstname' => @$request['pharmacy_firstname'],
                'pharmacy_lastname' => @$request['pharmacy_lastname'],
                'pharmacy_street1' => @$request['pharmacy_street1'],
                'pharmacy_street2' => @$request['pharmacy_street2'],
                'pharmacy_city' => @$request['pharmacy_city'],
                'pharmacy_zip_code' => @$request['pharmacy_zip_code'],
                'pharmacy_state' => @$request['pharmacy_state'],
                'pharmacy_home_phone' => @$request['pharmacy_home_phone'],
                'pharmacy_fax' => @$request['pharmacy_fax'],

                'dentist_name' => @$request['dentist_name'],
                'dentist_street1' => @$request['dentist_street1'],
                'dentist_street2' => @$request['dentist_street2'],
                'dentist_city' => @$request['dentist_city'],
                'dentist_zip_code' => @$request['dentist_zip_code'],
                'dentist_state' => @$request['dentist_state'],
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
     * AJAX API : add resident-personal information tab.
     *
     * @since 2021-07-10
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveResidentPersonalinfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_logo' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|string|unique:users|email', //|unique:users
            'birthday' => 'required',
            'gender' => 'required',
            'street1' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        ($request['gender'] == "male") ? $request['gender'] = 0 : $request['gender'] = 1;
        $dates = User::getformattime();
        $date = $dates['date'];

        DB::beginTransaction();

        try {
            $profile_logo = User::upload_file($request->profile_logo);

            $user = User::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'email' => $request['email'],
                'birthday' => $request['birthday'],
                'street1' => $request['street1'],
                'city' => $request['city'],
                'zip_code' => $request['zip_code'],
                'state' => $request['state'],
                'phone_number' => $request['phone_number'],
                'profile_logo' => $profile_logo,
                'gender' => $request['gender'],
                'middlename' => @$request['middlename'],
                'street2' => @$request['street2'],
                'sign_date' => $date,
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 3,
            ]);

            $resident_information = Resident_information::create([
                'user_id' => $user->id,
                'date_admitted' => @$request['date_admitted'],
                'ssn' => @$request['ssn'],
                'primary_language' => @$request['primary_language'],
                'signDate' => $date
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }  

        return response()->json(['status' => "success", 'data' => $user, 'msg' => 'Successfully added new Resident.']);
    }

    /**
     * AJAX API : add resident-POA information tab.
     *
     * @since 2021-07-10
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveResidentPOAinfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'poa_firstname' => 'required',
            // 'poa_type' => 'required',
            'poa_lastname' => 'required',
            'poa_street1' => 'required',
            'poa_city' => 'required',
            'poa_zip_code' => 'required',
            'poa_state' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $dates = User::getformattime();
        $date = $dates['date'];

        DB::beginTransaction();

        try {
            $poa = Poas::create([
                'user_id' => $request['user_id'],
                // 'poa_type' => $request['poa_type'],
                'poa_type' => 1,
                'poa_firstname' => $request['poa_firstname'],
                'poa_lastname' => $request['poa_lastname'],
                'poa_street1' => $request['poa_street1'],
                'poa_street2' => $request['poa_street2'],
                'poa_city' => $request['poa_city'],
                'poa_zip_code' => $request['poa_zip_code'],
                'poa_state' => $request['poa_state'],
                'poa_home_phone' => $request['poa_home_phone'],
                'poa_cell_phone' => $request['poa_cell_phone'],
                'sign_date' => $date,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }  

        return response()->json(['status' => "success", 'data' => $poa, 'msg' => 'Successfully added the POA information.']);
    }

    /**
     * AJAX API : add resident-Physician/Medical-Dentist information tab.
     *
     * @since 2021-07-13
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveResidentPhysicianinfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'physician_or_medical_group_firstname' => 'required',
            'physician_or_medical_group_lastname' => 'required',
            'physician_or_medical_group_street1' => 'required',
            'physician_or_medical_group_city' => 'required',
            'physician_or_medical_group_phone' => 'required',
            'physician_or_medical_group_fax' => 'required',
            'pharmacy_firstname' => 'required',
            'pharmacy_lastname' => 'required',
            'pharmacy_street1' => 'required',
            'pharmacy_city' => 'required',
            'pharmacy_phone' => 'required',
            'pharmacy_fax' => 'required',
            'dentist_firstname' => 'required',
            'dentist_lastname' => 'required',
            'dentist_street1' => 'required',
            'dentist_city' => 'required',
            'dentist_phone' => 'required',
            'dentist_fax' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $dates = User::getformattime();
        $date = $dates['date'];

        DB::beginTransaction();

        try {
            $physician_medical = Physician::create([
                'user_id' => $request['user_id'],
                'physician_or_medical_group_firstname' => $request['physician_or_medical_group_firstname'],
                'physician_or_medical_group_lastname' => $request['physician_or_medical_group_lastname'],
                'physician_or_medical_group_street1' => $request['physician_or_medical_group_street1'],
                'physician_or_medical_group_street2' => $request['physician_or_medical_group_street2'],
                'physician_or_medical_group_city' => $request['physician_or_medical_group_city'],
                'physician_or_medical_group_phone' => $request['physician_or_medical_group_phone'],
                'physician_or_medical_group_fax' => $request['physician_or_medical_group_fax'],
                'sign_date' => $date,
            ]);

            $pharmacy = Pharmacys::create([
                'user_id' => $request['user_id'],
                'pharmacy_firstname' => $request['pharmacy_firstname'],
                'pharmacy_lastname' => $request['pharmacy_lastname'],
                'pharmacy_street1' => $request['pharmacy_street1'],
                'pharmacy_street2' => $request['pharmacy_street2'],
                'pharmacy_city' => $request['pharmacy_city'],
                'pharmacy_phone' => $request['pharmacy_phone'],
                'pharmacy_fax' => $request['pharmacy_fax'],
                'sign_date' => $date,
            ]);

            $dentist = Dentists::create([
                'user_id' => $request['user_id'],
                'dentist_firstname' => $request['dentist_firstname'],
                'dentist_lastname' => $request['dentist_lastname'],
                'dentist_street1' => $request['dentist_street1'],
                'dentist_street2' => $request['dentist_street2'],
                'dentist_city' => $request['dentist_city'],
                'dentist_phone' => $request['dentist_phone'],
                'dentist_fax' => $request['dentist_fax'],
                'sign_date' => $date,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }  

        return response()->json(['status' => "success", 'data' => "", 'msg' => 'Successfully added the Physician/Medical, Dentist information.']);
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
