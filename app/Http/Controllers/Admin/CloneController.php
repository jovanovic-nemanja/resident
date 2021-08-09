<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Tabs;
use App\Moods;
use App\Units;
use App\Routes;
use App\Fields;
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
        $result = [];

        DB::beginTransaction();

        try {

            $activities = Activities::where('template_id', $request->template_id)->get();
            if($activities) {
                foreach ($activities as $activity) {
                    $activitys = Activities::create([
                        'title' => $activity->title,
                        'clinic_id' => $clinic_id,
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

            $bodyharmcomments = Bodyharmcomments::where('template_id', $request->template_id)->get();
            if ($bodyharmcomments) {
                foreach ($bodyharmcomments as $bodyharmcomment) {
                    $bodyharm_comment = Bodyharmcomments::create([
                        'name' => $bodyharmcomment->name,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date,
                    ]);
                }                
            }

            $healthtypes = HealthCareCenterTypes::where('template_id', $request->template_id)->get();
            if ($healthtypes) {
                foreach ($healthtypes as $healthtype) {
                    $type = HealthCareCenterTypes::create([
                        'title' => $healthtype->title,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $incidences = Incidences::where('template_id', $request->template_id)->get();
            if ($incidences) {
                foreach ($incidences as $incidence) {
                    $inc = Incidences::create([
                        'title' => $incidence->title,
                        'content' => $incidence->content,
                        'type' => $incidence->type,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $medications = Medications::where('template_id', $request->template_id)->get();
            if ($medications) {
                foreach ($medications as $medication) {
                    $medics = Medications::create([
                        'name' => $medication->name,
                        'dose' => $medication->dose,
                        'photo' => @$medication->photo,
                        'clinic_id' => $clinic_id,
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

            $moods = Moods::where('template_id', $request->template_id)->get();
            if($moods) {
                foreach ($moods as $mood) {
                    $mds = Moods::create([
                        'title' => $mood->title,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date
                    ]);
                }
            }

            $relations = Relations::where('template_id', $request->template_id)->get();
            if ($relations) {
                foreach ($relations as $relation) {
                    $rls = Relations::create([
                        'title' => $relation->title,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date
                    ]);
                }
            }

            $reminderConfigs = ReminderConfigs::where('template_id', $request->template_id)->get();
            if ($reminderConfigs) {
                foreach ($reminderConfigs as $reminderConfig) {
                    $reminderConfigs = ReminderConfigs::create([
                        'minutes' => $reminderConfig->minutes,
                        'clinic_id' => $clinic_id,
                        'active' => $reminderConfig->active,
                        'sign_date' => $date,
                    ]);
                }
            }

            $reptypes = RepresentativeTypes::where('template_id', $request->template_id)->get();
            if ($reptypes) {
                foreach ($reptypes as $reptype) {
                    $rtype = RepresentativeTypes::create([
                        'title' => $reptype->title,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $routes = Routes::where('template_id', $request->template_id)->get();
            if($routes) {
                foreach ($routes as $route) {
                    $rts = Routes::create([
                        'name' => $route->name,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $units = Units::where('template_id', $request->template_id)->get();
            if($units) {
                foreach ($units as $unit) {
                    $uts = Units::create([
                        'title' => $unit->title,
                        'clinic_id' => $clinic_id,
                        'sign_date' => $date,
                    ]);
                }
            }

            $fields = Fields::where('template_id', $request->template_id)->get();
            if ($fields) {
                foreach ($fields as $field) {
                    $fld = new Fields;

                    $fld->fieldName = $field->fieldName;
                    $fld->tab_id = $field->tab_id;
                    $fld->clinic_id = $clinic_id;
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

        $template = Templates::where('id', $id)->first();
        $activities = Activities::where('template_id', $id)->get();
        $comments = Bodyharmcomments::where('template_id', $id)->get();
        $healthcarecentertypes = HealthCareCenterTypes::where('template_id', $id)->get();
        $incidences = Incidences::where('template_id', $id)->get();
        $medications = Medications::where('template_id', $id)->get();
        $moods = Moods::where('template_id', $id)->get();
        $relations = Relations::where('template_id', $id)->get();
        $reminderconfigs = ReminderConfigs::where('template_id', $id)->get();
        $types = RepresentativeTypes::where('template_id', $id)->get();
        $routes = Routes::where('template_id', $id)->get();
        $units = Units::where('template_id', $id)->get();
        $settings = DB::table('setting_tabs')
                            ->join('fields', 'setting_tabs.id', '=', 'fields.tab_id')
                            ->where('fields.template_id', $id)
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
