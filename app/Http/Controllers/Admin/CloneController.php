<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Tabs;
use App\Role;
use App\Moods;
use App\Units;
use App\Routes;
use App\Fields;
use App\RoleUser;
use App\Comments;
use App\Bodyharms;
use App\Relations;
use App\Templates;
use App\FieldTypes;
use App\Activities;
use App\Incidences;
use App\Medications;
use App\ReportClone;
use App\MoodChanges;
use App\FamilyVisits;
use App\Useractivities;
use App\Usermedications;
use App\ReminderConfigs;
use App\Representatives;
use App\Bodyharmcomments;
use App\AssignMedications;
use App\Useractivityreports;
use Illuminate\Http\Request;
use App\RepresentativeTypes;
use Illuminate\Http\Response;
use App\HealthCareCenterTypes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CloneController extends Controller
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
        $templates = Templates::all();

        return view('admin.clone.index', compact('templates'));
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
        
    }

    /**
     * Store a newly created resource in storage via Ajax.
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cloneSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'template_id' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        $admin_role = Role::where('name', 'admin')->first();
        if ($admin_role) {
            $roleuser = RoleUser::where('role_id', $admin_role->id)->first();
            $adminID = $roleuser->user_id;
        }else{
            $adminID = 1;
        }

        $result = [];

        DB::beginTransaction();

        try {

            $activities = Activities::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if($activities) {
                
                // delete part for old cloned activities
                $cloned_activities = Activities::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->get();
                if($cloned_activities) {
                    foreach ($cloned_activities as $ca) {
                        $old_user_activities = Useractivities::where('activities', $ca->id)->get();
                        if($old_user_activities) {
                            foreach ($old_user_activities as $old_user_activity) {
                                $old_reports_useractivity = Useractivityreports::where('assign_id', $old_user_activity->id)->delete();
                            }
                            $old_user_activitys = Useractivities::where('activities', $ca->id)->delete();
                        }
                    }
                    $cloned_activitys = Activities::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();
                }
                // ended delete part

                foreach ($activities as $activity) {
                    $activitys = Activities::create([
                        'title' => $activity->title,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'type' => $activity->type,
                        'comments' => $activity->comments,
                        'sign_date' => $date,
                    ]);

                    if (@$activity->comments) {
                        $arrs = explode(',', $activity->comments);
                        foreach ($arrs as $comm) {
                            $comments = Comments::create([
                                'type' => 1,
                                'sign_date' => $date,
                                'name' => $comm,
                                'ref_id' => $activitys['id']
                            ]);
                        }
                    }
                }
            }

            $bodyharmcomments = Bodyharmcomments::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($bodyharmcomments) {
                
                $bhcs = Bodyharmcomments::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($bodyharmcomments as $bodyharmcomment) {
                    $bodyharm_comment = Bodyharmcomments::create([
                        'name' => $bodyharmcomment->name,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date,
                    ]);
                }                
            }

            $healthtypes = HealthCareCenterTypes::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($healthtypes) {

                $healtypes = HealthCareCenterTypes::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($healthtypes as $healthtype) {
                    $type = HealthCareCenterTypes::create([
                        'title' => $healthtype->title,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $incidences = Incidences::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($incidences) {

                $incis = Incidences::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($incidences as $incidence) {
                    $inc = Incidences::create([
                        'title' => $incidence->title,
                        'content' => $incidence->content,
                        'type' => $incidence->type,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $medications = Medications::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($medications) {

                $mds = Medications::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->get();
                if($mds) {
                    foreach ($mds as $md) {
                        $assigned_ms = AssignMedications::where('medications', $md->id)->get();
                        if($assigned_ms) {
                            foreach ($assigned_ms as $assigned_m) {
                                $u_ms = Usermedications::where('assign_id', $assigned_m->id)->delete();
                            }
                        }

                        $assigned_ms = AssignMedications::where('medications', $md->id)->delete();
                    }   

                    $mds = Medications::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();
                }

                foreach ($medications as $medication) {
                    $medics = Medications::create([
                        'name' => $medication->name,
                        'brand_name' => $medication->brand_name,
                        'photo' => @$medication->photo,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date,
                        'comments' => $medication->comments
                    ]);

                    if (@$medication->comments) {
                        $arrs = explode(',', $medication->comments);
                        foreach ($arrs as $comm) {
                            $comments = Comments::create([
                                'type' => 2,
                                'sign_date' => $date,
                                'name' => $comm,
                                'ref_id' => $medics['id']
                            ]);
                        }
                    }
                }
            }

            $moods = Moods::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if($moods) {

                $mds = Moods::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($moods as $mood) {
                    $mds = Moods::create([
                        'title' => $mood->title,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date
                    ]);
                }
            }

            $relations = Relations::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($relations) {

                $relas = Relations::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($relations as $relation) {
                    $rls = Relations::create([
                        'title' => $relation->title,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date
                    ]);
                }
            }

            $reminderConfigs = ReminderConfigs::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($reminderConfigs) {

                $remcs = ReminderConfigs::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($reminderConfigs as $reminderConfig) {
                    $reminderConfigs = ReminderConfigs::create([
                        'minutes' => $reminderConfig->minutes,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'active' => $reminderConfig->active,
                        'sign_date' => $date,
                    ]);
                }
            }

            $reptypes = RepresentativeTypes::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($reptypes) {

                $repts = RepresentativeTypes::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($reptypes as $reptype) {
                    $rtype = RepresentativeTypes::create([
                        'title' => $reptype->title,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $routes = Routes::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if($routes) {

                $rts = Routes::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($routes as $route) {
                    $rts = Routes::create([
                        'name' => $route->name,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $units = Units::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if($units) {

                $uts = Units::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();

                foreach ($units as $unit) {
                    $uts = Units::create([
                        'title' => $unit->title,
                        'clinic_id' => $clinic_id,
                        'template_id' => $request->template_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $fields = Fields::where('template_id', $request->template_id)->where('clinic_id', $adminID)->get();
            if ($fields) {

                $filds = Fields::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->get();
                if($filds) {
                    foreach ($filds as $fild) {
                       $fitypes = FieldTypes::where('fieldID', $fild->id)->delete();
                    }

                    $fis = Fields::where('template_id', $request->template_id)->where('clinic_id', $clinic_id)->delete();
                }

                foreach ($fields as $field) {
                    $fld = new Fields;

                    $fld->fieldName = $field->fieldName;
                    $fld->tab_id = $field->tab_id;
                    $fld->clinic_id = $clinic_id;
                    $fld->template_id = $request->template_id;
                    $fld->sign_date_field = $date;
                    $fld->save();

                    $fieldID = $fld->id;

                    $fieldtypes = FieldTypes::where('fieldID', $field->id)->get();
                    foreach ($fieldtypes as $fv) {
                        $fieldtypes = new FieldTypes;

                        $fieldtypes->typeName = $fv->typeName;
                        $fieldtypes->fieldID = $fieldID;
                        $fieldtypes->sign_date_field_type = $date;
                        $fieldtypes->save();
                    }
                }
            }

            $logs = ReportClone::create([
                'user_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date
            ]);

            DB::commit();
            
            $result['status'] = "success";
            $result['msg'] = "Successfully cloned the template to your setting list.";
            $result['redirectLink'] = route('clone.index');

        } catch (\Exception $e) {
            DB::rollback();

            $result['status'] = "failed";
            $result['msg'] = "Sorry, Failed the cloning operation!";
            $result['redirectLink'] = '';

            throw $e;
        }  

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dates = User::getformattime();
        $date = $dates['date'];
        $admin_role = Role::where('name', 'admin')->first();
        if ($admin_role) {
            $roleuser = RoleUser::where('role_id', $admin_role->id)->first();
            $adminID = $roleuser->user_id;
        }else{
            $adminID = 1;
        }

        $template = Templates::where('id', $id)->first();
        $activities = Activities::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $comments = Bodyharmcomments::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $healthcarecentertypes = HealthCareCenterTypes::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $incidences = Incidences::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $medications = Medications::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $moods = Moods::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $relations = Relations::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $reminderconfigs = ReminderConfigs::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $types = RepresentativeTypes::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $routes = Routes::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $units = Units::where('template_id', $id)->where('clinic_id', $adminID)->get();
        $settings = DB::table('setting_tabs')
                            ->join('fields', 'setting_tabs.id', '=', 'fields.tab_id')
                            ->where('fields.template_id', $id)
                            ->where('fields.clinic_id', $adminID)
                            ->select('setting_tabs.*', 'fields.id as FieldID', 'fields.*')
                            ->get();

        return view('admin.clone.view', compact('template', 'activities', 'comments', 'healthcarecentertypes', 'incidences', 'medications', 'moods', 'relations', 'reminderconfigs', 'types', 'routes', 'settings', 'units'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showsetting($templateID, $id)
    {
        $setting_tabs = Tabs::all();
        $result = Fields::where('id', $id)->first();
        $fieldtypes = FieldTypes::where('fieldID', $id)->get();

        return view('admin.clone.showsetting', compact('setting_tabs', 'result', 'fieldtypes', 'templateID'));
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
}
