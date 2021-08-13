<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Adminlogs;
use App\RoleUser;
use App\Facilities;
use App\Usermedications;
use App\Useractivities;
use App\Useractivityreports;
use App\Assignmedications;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $facility = Facilities::where('clinic_id', $id)->first();
        
        $resident_role = 3;
        $caretaker_role = 2;

        $residents = DB::table('users')
                            ->join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', $resident_role)
                            ->where('users.clinic_id', $id)
                            ->select('users.*')
                            ->get();

        $caretakers = DB::table('users')
                            ->join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', $caretaker_role)
                            ->where('users.clinic_id', $id)
                            ->select('users.*')
                            ->get();
        
        return view('admin.facility.viewfacility', compact('user', 'facility', 'residents', 'caretakers'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Delete the facility info via Ajax.
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteFacility(Request $request)
    {
        $result = [];

        DB::beginTransaction();

        $id = $request->user_id;

        try {

            $user_medications = Usermedications::where('user', $id)->get();
            if ($user_medications) {
                foreach($user_medications as $um) {
                    $assigned_medications = Assignmedications::where('id', $um->assign_id)->delete();
                }

                $ums = Usermedications::where('user', $id)->delete();
            }

            $user_activities = Useractivityreports::where('user', $id)->get();
            if ($user_activities) {
                foreach($user_activities as $ua) {
                    $assigned_activities = Useractivities::where('id', $ua->assign_id)->delete();
                }

                $uas = Useractivities::where('user', $id)->delete();
            }

            $facility = Facilities::where('clinic_id', $id)->delete();
            $roleuser = RoleUser::where('user_id', $id)->delete();
            $adminlogs = Adminlogs::where('clinic_id', $id)->delete();
            $bodyharmcomments = Bodyharmcomments::where('clinic_id', $id)->delete();
            $bodyharmcomments = Bodyharmcomments::where('clinic_id', $id)->delete();
            
            $fields = Fields::where('clinic_id', $id)->get();
            if($fields) {
                foreach ($fields as $fl) {
                    $fields_types = FieldTypes::where('fieldID', $fl->id)->delete();
                }
            }
            $fds = Fields::where('clinic_id', $id)->delete();

            $healthcarecentertypes = HealthCareCenterTypes::where('clinic_id', $id)->delete();
            $incidences = Incidences::where('clinic_id', $id)->delete();

            $medications = Medications::where('clinic_id', $id)->get();
            if ($medications) {
                foreach ($medications as $mcs) {
                    $assign_mics = Assignmedications::where('medications', $mcs->id)->delete();
                }
            }
            $medicins = Medications::where('clinic_id', $id)->delete();

            $moods = Moods::where('clinic_id', $id)->delete();

            DB::commit();
            
            $result['status'] = "success";
            $result['msg'] = "Successfully deleted the facility information to our records.";
            $result['redirectLink'] = route('home');

        } catch (\Exception $e) {
            DB::rollback();

            $result['status'] = "failed";
            $result['msg'] = "Sorry, Failed the deleted operation!";
            $result['redirectLink'] = '';

            throw $e;
        }  

        return response()->json($result);
    }
}
