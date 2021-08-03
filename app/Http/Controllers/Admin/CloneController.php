<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Tabs;
use App\Moods;
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

        $result = route('clone.index');
        
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
        $settings = DB::table('setting_tabs')
                            ->join('fields', 'setting_tabs.id', '=', 'fields.tab_id')
                            ->where('fields.template_id', $id)
                            ->select('setting_tabs.*', 'fields.id as FieldID', 'fields.*')
                            ->get();

        return view('admin.clone.view', compact('template', 'activities', 'comments', 'healthcarecentertypes', 'incidences', 'medications', 'moods', 'relations', 'reminderconfigs', 'types', 'routes', 'settings'));
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
