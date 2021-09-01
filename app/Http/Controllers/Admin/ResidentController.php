<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\TFG;
use App\Tabs;
use App\User;
use App\Role;
use App\Fields;
use App\FieldTypes;
use App\RoleUser;
use App\Bodyharms;
use App\Vitalsign;
use App\Useractivities;
use App\Representatives;
use App\Usermedications;
use App\ResidentSettings;
use App\HealthCareCenters;
use App\Assignmedications;
use App\Useractivityreports;
use App\Resident_information;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
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
        $clinic_id = auth()->id();
        $fields = DB::table('setting_tabs')
                    ->leftJoin('fields', 'fields.tab_id', '=', 'setting_tabs.id')
                    ->where('fields.clinic_id', $clinic_id)
                    ->select('fields.*')
                    ->get();

        return view('admin.resident.create', compact('fields'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexprofile($resident, $id)
    {
        $setting_tab = Tabs::where('id', $id)->first();
        $user = User::where('id', $resident)->first();

        $resident_settings =  DB::table('resident_settings')
                                ->leftJoin('field_types', 'field_types.id', '=', 'resident_settings.fieldVal')
                                ->leftJoin('fields', 'fields.id', '=', 'field_types.fieldID')
                                ->leftJoin('setting_tabs', 'setting_tabs.id', '=', 'fields.tab_id')
                                ->where('resident_settings.user_id', $resident)
                                ->where('fields.tab_id', $id)
                                ->where('field_types.typeName', '!=', 'None')
                                ->select('setting_tabs.name as tabName', 'fields.fieldName', 'field_types.typeName', 'resident_settings.id')
                                ->get();

        return view('admin.resident.indexprofile', compact('setting_tab', 'resident_settings', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createprofile($resident, $id)
    {
        $setting_tab = Tabs::where('id', $id)->first();
        $user = User::where('id', $resident)->first();
        $clinic_id = auth()->id();

        $resident_settings =  DB::table('fields')
                                ->leftJoin('setting_tabs', 'setting_tabs.id', '=', 'fields.tab_id')
                                ->where('fields.tab_id', $id)
                                ->where('fields.clinic_id', $clinic_id)
                                ->select('fields.*')
                                ->get();

        return view('admin.resident.createprofile', compact('setting_tab', 'resident_settings', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeprofile(Request $request)
    {
        $this->validate(request(), [
            'value' => 'required',
            'resident' => 'required'
        ]);
        
        DB::beginTransaction();

        $dates = User::getformattime();
        $date = $dates['date'];

        try {
            foreach ($request['value'] as $v) {
                $resident_setting = ResidentSettings::create([
                    'user_id' => $request['resident'],
                    'fieldVal' => $v,
                    'sign_date' => $date,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('resident.indexprofile', [$request->resident, $request->tab_id])->with('flash', 'Successfully added new setting.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showprofile($id)
    {
        $resident_setting = ResidentSettings::where('id', $id)->first();
        $user = User::where('id', $resident_setting->user_id)->first();
        $fieldtype = FieldTypes::where('id', $resident_setting->fieldVal)->first();
        if (@$fieldtype) {
            $fieldID = $fieldtype->fieldID;
            $field = Fields::where('id', $fieldID)->first();
            $field_types = FieldTypes::where('fieldID', $fieldID)->get();
            $tabID = $field->tab_id;
        }

        return view('admin.resident.editprofile', compact('field', 'field_types', 'user', 'resident_setting', 'tabID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateprofile(Request $request, $id)
    {
        $this->validate(request(), [
            'value' => 'required'
        ]);
        
        DB::beginTransaction();

        $dates = User::getformattime();
        $date = $dates['date'];

        try {
            $record = ResidentSettings::where('id', $id)->first();

            if(@$record) {
                $record->fieldVal = $request->value;

                $record->update();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('resident.indexprofile', [$request->resident, $request->tab_id])->with('flash', 'Successfully updated new setting.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyprofile($id)
    {
        $record = ResidentSettings::where('id', $id)->delete();
        
        return back()->with('flash', 'Setting has been successfully deleted.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function management()
    {
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $user = User::where('id', $clinic_id)->first();
            
            $residents = DB::table('users')
                            ->select('users.*')
                            ->Join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', 3)
                            ->where('users.clinic_id', $clinic_id)
                            ->get();

        }else {

            $userid = auth()->id();
            $user = User::where('id', $userid)->first();
            $clinic_id = $user->clinic_id;
            $residents = DB::table('users')
                            ->select('users.*')
                            ->Join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', 3)
                            ->where('users.clinic_id', $clinic_id)
                            ->get();

        }

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
            'email' => 'required|string|email|max:255',
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
            'email' => 'required|string|email',
            'birthday' => 'required',
            'gender' => 'required',
            'street1' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'phone_number' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        ($request['gender'] == "male") ? $request['gender'] = 0 : $request['gender'] = 1;
        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

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
                'clinic_id' => $clinic_id,
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

        return response()->json(['status' => "success", 'data' => $user, 'msg' => 'Successfully added new Resident.', 'url' => route('home')]);
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

        $representatives = Representatives::where('user_id', $id)->get();
        $healthcarecenters = HealthCareCenters::where('user_id', $id)->get();
        $setting_tabs = Tabs::all();

        $resident_settings =  DB::table('resident_settings')
                                ->leftJoin('field_types', 'field_types.id', '=', 'resident_settings.fieldVal')
                                ->leftJoin('fields', 'fields.id', '=', 'field_types.fieldID')
                                ->leftJoin('setting_tabs', 'setting_tabs.id', '=', 'fields.tab_id')
                                ->where('resident_settings.user_id', $id)
                                ->select('setting_tabs.name as tabName', 'fields.fieldName', 'field_types.typeName')
                                ->get();

        return view('admin.resident.viewuser', compact('user', 'vitalsign', 'representatives', 'healthcarecenters', 'resident_settings', 'setting_tabs'));
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
        $resident_info = Resident_information::where('user_id', $id)->first();

        return view('admin.resident.edit', compact('resident', 'resident_info'));
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'gender' => 'required',
            'birthday' => 'required|date',
            'street1' => 'required|string'
        ]);

        $record = User::where('id', $id)->first();
        ($request['gender'] == "male") ? $request['gender'] = 0 : $request['gender'] = 1;

        if (@$record) {
            $record->firstname = $request->firstname;
            $record->lastname = $request->lastname;
            $record->email = $request->email;
            $record->gender = $request->gender;
            $record->street1 = $request->street1;
            $record->street2 = @$request->street2;
            $record->birthday = $request->birthday;
            $record->city = @$request->city;
            $record->zip_code = @$request->zip_code;
            $record->state = @$request->state;
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

    /**
     * Display the resident profile information.
     * @author Nemanja
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quickreport($id)
    {
        $user = User::where('id', $id)->first();
        $representatives = Representatives::where('user_id', $id)->get();
        $healthcarecenters = HealthCareCenters::where('user_id', $id)->get();
        $setting_tabs = Tabs::all();

        $resident_settings =  DB::table('resident_settings')
                                ->leftJoin('field_types', 'field_types.id', '=', 'resident_settings.fieldVal')
                                ->leftJoin('fields', 'fields.id', '=', 'field_types.fieldID')
                                ->leftJoin('setting_tabs', 'setting_tabs.id', '=', 'fields.tab_id')
                                ->where('resident_settings.user_id', $id)
                                ->select('setting_tabs.name as tabName', 'fields.fieldName', 'field_types.typeName')
                                ->get();

        return view('admin.resident.quickreports', compact('user', 'representatives', 'healthcarecenters', 'resident_settings', 'setting_tabs'));
    }

    /**
     * Export the pdf.
     * @author Nemanja
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportPDF($id)
    {
        // Fetch all customers from database
        $data = [];
        $data['user'] = User::where('id', $id)->first();
        $data['representatives'] = Representatives::where('user_id', $id)->get();
        $data['healthcarecenters'] = HealthCareCenters::where('user_id', $id)->get();
        $data['setting_tabs'] = Tabs::all();

        $data['resident_settings'] =  DB::table('resident_settings')
                                ->leftJoin('field_types', 'field_types.id', '=', 'resident_settings.fieldVal')
                                ->leftJoin('fields', 'fields.id', '=', 'field_types.fieldID')
                                ->leftJoin('setting_tabs', 'setting_tabs.id', '=', 'fields.tab_id')
                                ->where('resident_settings.user_id', $id)
                                ->select('setting_tabs.name as tabName', 'fields.fieldName', 'field_types.typeName')
                                ->get();

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('admin.resident.exportPDF', $data);

        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path('app/../../public/uploads/'). $data['user']->firstname . '-quick-report.pdf');

        // Finally, you can download the file using download function
        return $pdf->download($data['user']->firstname . '-quick-report.pdf');
    }
}
