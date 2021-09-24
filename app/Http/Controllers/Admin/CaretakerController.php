<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use Route;
use App\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CaretakerController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'manager'])->except(['validationUsername', 'getOutlink']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinic_id = auth()->id();
        $caretakers = User::where('clinic_id', $clinic_id)->get();
        
        return view('admin.caretaker.index', compact('caretakers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.caretaker.create');
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
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'string|max:20',
            'profile_logo'      => 'required',
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];

        $clinic_id = auth()->id();
        
        DB::beginTransaction();

        try {
            $user = User::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'username' => $request['username'],
                'email' => $request['email'],
                'clinic_id' => $clinic_id,
                'profile_logo' => $request['profile_logo'],
                'password' => Hash::make($request['password']),
                'phone_number' => $request['phone_number'],
                'sign_date' => $date,
            ]);

            User::upload_logo_img($user->id);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 2,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('caretaker.index')->with('flash', 'Successfully added caretaker.');
    }

    public function storeAJAX(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'profile_logo'      => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $dates = User::getformattime();
        $date = $dates['date'];

        $clinic_id = auth()->id();
        
        DB::beginTransaction();

        try {
            $profile_logo = User::upload_caregiver_profile($request->profile_logo);

            $user = User::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'username' => $request['username'],
                'email' => $request['email'],
                'clinic_id' => $clinic_id,
                'profile_logo' => $profile_logo,
                'password' => Hash::make($request['password']),
                'phone_number' => $request['phone_number'],
                'sign_date' => $date,
            ]);

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 2,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return response()->json(['status' => "success", 'msg' => 'Successfully added caretaker.', 'url' => route('caretaker.index')]);
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

        return view('admin.caretaker.edit', compact('user'));
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'string|max:20',
        ]);

        $record = User::where('id', $id)->first();
        if (@$record) {
            $record->firstname = $request->firstname;
            $record->lastname = $request->lastname;
            $record->username = $request->username;
            $record->password = Hash::make($request['password']);
            $record->phone_number = $request->phone_number;
            if (@$request->profile_logo) {
                $record->profile_logo = $request->profile_logo;
            }
            $record->update();
        }
        
        if (@$request->profile_logo) {
            User::upload_logo_img($record->id);
        }

        return redirect()->route('caretaker.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::where('id', $id)->delete();
        
        return redirect()->route('caretaker.index');
    }

    /**
     * validate the username for caregiver
     * @param username
     * @author Nemanja
     * @since 2021-07-21
     * @return boolean true or false for validation with message
     */
    public function validationUsername(Request $request)
    {
        if($request->username) {
            $user = User::where('username', $request->username)->first();   
            if(@$user) {
                $status = false;
                $msg = "Sorry, Please change the entered username. This seems to used by someone. Username is Unique field.";
            }else {
                $status = true;
                $msg = "Ok";
            }
        }else {
            $status = false;
            $msg = "Sorry, Please enter the username. This is required.";
        }

        return response()->json(['status' => $status, 'msg' => $msg]); 
    }

    /**
     * get users who enabled the looking for job status in bluecarecoach.com
     * @author Nemanja
     * @since 2021-09-24
     * @return user lists
     */
    public function getExternaldata()
    {
        $outlink = "https://bluecarecoach.com/api/v1/getUserswithLookingjob";
        $caretakers = $this->runExternallink($outlink);

        return view('admin.caretaker.indexbluecarecoach', compact('caretakers'));
    }

    private function runExternallink($link)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
