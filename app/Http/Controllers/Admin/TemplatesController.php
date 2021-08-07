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

class TemplatesController extends Controller
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
        $templates = Templates::all();

        return view('admin.templates.index', compact('templates'));
    }

    public function viewTemplate($templateID)
    {
        if (@$templateID) {
            $dates = User::getformattime();
            $date = $dates['date'];

            $record = Templates::where('id', $templateID)->first();
            if (@$record) {
                ($record->name) ? $record->name = $record->name : $record->name = $templateID;
                $record->sign_date = $date;

                $record->update();
            }
            $template = $record;

            $activities = Activities::where('template_id', $templateID)->get();
            $comments = Bodyharmcomments::where('template_id', $templateID)->get();
            $healthcarecentertypes = HealthCareCenterTypes::where('template_id', $templateID)->get();
            $incidences = Incidences::where('template_id', $templateID)->get();
            $medications = Medications::where('template_id', $templateID)->get();
            $moods = Moods::where('template_id', $templateID)->get();
            $relations = Relations::where('template_id', $templateID)->get();
            $reminderconfigs = ReminderConfigs::where('template_id', $templateID)->get();
            $types = RepresentativeTypes::where('template_id', $templateID)->get();
            $routes = Routes::where('template_id', $templateID)->get();
            
            $clinic_id = auth()->id();
            $settings = DB::table('setting_tabs')
                                ->join('fields', 'setting_tabs.id', '=', 'fields.tab_id')
                                ->where('fields.clinic_id', $clinic_id)
                                ->select('setting_tabs.*', 'fields.id as FieldID', 'fields.*')
                                ->get();

            return view('admin.templates.create', compact('template', 'activities', 'comments', 'healthcarecentertypes', 'incidences', 'medications', 'moods', 'relations', 'reminderconfigs', 'types', 'routes', 'settings'));
        }            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = Templates::create();

        return redirect()->route('templates.viewTemplate', $template->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createsetting($templateID, $type)
    {
        if(@$type) {
            if($type == 1) {    //Activities
                return view('admin.templates.createactivity', compact('templateID'));
            }else if($type == 2) {  //Body Harm Comments
                return view('admin.templates.createbodyharmcomment', compact('templateID'));
            }else if($type == 3) {  //Health Care Center Types
                return view('admin.templates.createhealthcarecentertype', compact('templateID'));
            }else if($type == 4) {  //Incidences
                return view('admin.templates.createincidence', compact('templateID'));
            }else if($type == 5) {  //Medications
                return view('admin.templates.createmedication', compact('templateID'));
            }else if($type == 6) {  //Moods
                return view('admin.templates.createmood', compact('templateID'));
            }else if($type == 7) {  //Relations
                return view('admin.templates.createrelation', compact('templateID'));
            }else if($type == 8) {  //Reminder Configs
                return view('admin.templates.createreminderconfig', compact('templateID'));
            }else if($type == 9) {  //Representative Types
                return view('admin.templates.createrepresentativetype', compact('templateID'));
            }else if($type == 10) {  //Routes
                return view('admin.templates.createroute', compact('templateID'));
            }else if($type == 11) {  //Settings
                $setting_tabs = Tabs::all();

                return view('admin.templates.createsetting', compact('templateID', 'setting_tabs'));
            }
        }
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
            'name' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];

        $template = Templates::create([
            'title' => $request->title,
            'clinic_id' => $clinic_id,
            'type' => $request->type,
            'comments' => $request->comments,
            'sign_date' => $date,
        ]);

        return redirect()->route('templates.index')->with('flash', 'Activity has been successfully created.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSetting(Request $request)
    {
        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        if($request->setting_type == 1) {   //activity
            $this->validate(request(), [
                'template_id' => 'required',
                'type' => 'required',
                'title' => 'required',
                'type' => 'required'
            ]);

            $activities = Activities::create([
                'title' => $request->title,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'type' => $request->type,
                'comments' => $request->comments,
                'sign_date' => $date,
            ]);

            if (@$request->comments) {
                $arrs = explode(',', $request->comments);
                foreach ($arrs as $comm) {
                    $comments = Comments::create([
                        'type' => 1,
                        'sign_date' => $date,
                        'name' => $comm,
                        'ref_id' => $activities['id']
                    ]);
                }
            }

            $msg = 'Activity has been successfully created.';
        }else if($request->setting_type == 2) { //body harm comment
            $this->validate(request(), [
                'template_id' => 'required',
                'name' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];
            $clinic_id = auth()->id();

            $comment = Bodyharmcomments::create([
                'name' => $request->name,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date,
            ]);

            $msg = 'Comment has been successfully created.';
        }else if($request->setting_type == 3) { //health care center type
            $this->validate(request(), [
                'template_id' => 'required',
                'title' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];
            $clinic_id = auth()->id();

            $type = HealthCareCenterTypes::create([
                'title' => $request->title,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date,
            ]);

            $msg = 'Health Care center Type has been successfully created.';
        }else if($request->setting_type == 4) { //incidence
            $this->validate(request(), [
                'template_id' => 'required',
                'title' => 'required',
                'type' => 'required'
            ]);

            $incidences = Incidences::create([
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date,
            ]);

            $msg = 'Incidence has been successfully created.';
        }else if($request->setting_type == 5) { //medication
            $this->validate(request(), [
                'template_id' => 'required',
                'name' => 'required',
                'brand_name' => 'required'
            ]);

            $medication = Medications::create([
                'name' => $request->name,
                'brand_name' => $request->brand_name,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
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
                        'ref_id' => $medication['id']
                    ]);
                }
            }

            $msg = 'Medication has been successfully created.';
        }else if($request->setting_type == 6) { //mood
            $this->validate(request(), [
                'template_id' => 'required',
                'title' => 'required'
            ]);

            $moods = Moods::create([
                'title' => $request->title,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date
            ]);

            $msg = 'Mood has been successfully created.';
        }else if($request->setting_type == 7) { //relation
            $this->validate(request(), [
                'template_id' => 'required',
                'title' => 'required'
            ]);

            $relations = Relations::create([
                'title' => $request->title,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date
            ]);

            $msg = 'Relation has been successfully created.';
        }else if($request->setting_type == 8) { //reminder config
            $this->validate(request(), [
                'template_id' => 'required',
                'minutes' => 'required'
            ]);

            $reminderConfigs = ReminderConfigs::create([
                'minutes' => $request->minutes,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'active' => $request->active,
                'sign_date' => $date,
            ]);

            $msg = 'Reminder Config has been successfully created.';
        }else if($request->setting_type == 9) { //representative types
            $this->validate(request(), [
                'template_id' => 'required',
                'title' => 'required'
            ]);

            $type = RepresentativeTypes::create([
                'title' => $request->title,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date,
            ]);

            $msg = 'Representative Type has been successfully created.';
        }else if($request->setting_type == 10) { //route
            $this->validate(request(), [
                'template_id' => 'required',
                'name' => 'required'
            ]);

            $routes = Routes::create([
                'name' => $request->name,
                'clinic_id' => $clinic_id,
                'template_id' => $request->template_id,
                'sign_date' => $date,
            ]);

            $msg = 'Route has been successfully created.';
        }

        return redirect()->route('templates.viewTemplate', $request->template_id)->with('flash', $msg);
    }

    /**
     * Store a newly created resource in storage via Ajax.
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tabsID' => 'required',
            'template_id' => 'required',
            'arrayValue' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'msg' => $messages->first()]);
        }

        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        $arrayValue = json_decode($request->arrayValue);
        if($arrayValue) {
            foreach ($arrayValue as $arr) {
                
                $field = new Fields;

                $field->fieldName = $arr->fieldName;
                $field->tab_id = $request->tabsID;
                $field->template_id = $request->template_id;
                $field->clinic_id = $clinic_id;
                $field->sign_date_field = $date;
                $field->save();
                
                $fieldID = $field->id;

                foreach ($arr->fieldValue as $fv) {
                    $fieldtypes = new FieldTypes;

                    $fieldtypes->typeName = $fv;
                    $fieldtypes->fieldID = $fieldID;
                    $fieldtypes->sign_date_field_type = $date;
                    $fieldtypes->save();
                }
            }
        }

        $result = route('templates.viewTemplate', $request->template_id);
        
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
        $result = Templates::where('id', $id)->first();

        return view('admin.templates.edit', compact('result'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showsetting($templateID, $id, $type)
    {   
        if($type == 1) {    //activity
            $result = Activities::where('id', $id)->first();

            return view('admin.templates.editactivity', compact('result', 'templateID'));
        }else if($type == 2) {    //body harm comment
            $result = Bodyharmcomments::where('id', $id)->first();

            return view('admin.templates.editbodyharmcomment', compact('result', 'templateID'));
        }else if($type == 3) {    //health care center type
            $result = HealthCareCenterTypes::where('id', $id)->first();

            return view('admin.templates.edithealthcarecentertype', compact('result', 'templateID'));
        }else if($type == 4) {    //incidence
            $result = Incidences::where('id', $id)->first();

            return view('admin.templates.editincidence', compact('result', 'templateID'));
        }else if($type == 5) {    //medication
            $result = Medications::where('id', $id)->first();

            return view('admin.templates.editmedication', compact('result', 'templateID'));
        }else if($type == 6) {    //mood
            $result = Moods::where('id', $id)->first();

            return view('admin.templates.editmood', compact('result', 'templateID'));
        }else if($type == 7) {    //relation
            $result = Relations::where('id', $id)->first();

            return view('admin.templates.editrelation', compact('result', 'templateID'));
        }else if($type == 8) {    //reminder config
            $result = ReminderConfigs::where('id', $id)->first();

            return view('admin.templates.editreminderconfig', compact('result', 'templateID'));
        }else if($type == 9) {    //representative type
            $result = RepresentativeTypes::where('id', $id)->first();

            return view('admin.templates.editrepresentativetype', compact('result', 'templateID'));
        }else if($type == 10) {    //route
            $result = Routes::where('id', $id)->first();

            return view('admin.templates.editroute', compact('result', 'templateID'));
        }else{  //settings
            $setting_tabs = Tabs::all();

            $result = Fields::where('id', $id)->first();
            $fieldtypes = FieldTypes::where('fieldID', $id)->get();

            return view('admin.templates.editsetting', compact('setting_tabs', 'result', 'fieldtypes', 'templateID'));
        }
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
            'name' => 'required'
        ]);

        $record = Templates::where('id', $id)->first();
        if (@$record) {
            $record->name = $request->name;

            $record->update();
        }

        return redirect()->route('templates.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatesetting(Request $request, $id)
    {
        if($request->setting_type == 1) {   //activity
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'title' => 'required',
                'type' => 'required'
            ]);

            $record = Activities::where('id', $id)->first();
            if (@$record) {
                $record->title = $request->title;
                $record->type = $request->type;
                $record->comments = $request->comments;

                $record->update();
            }

            $dates = User::getformattime();
            $date = $dates['date'];

            if (@$request->comments) {
                $arrs = explode(',', $request->comments);
                $del = Comments::where('type', 1)->where('ref_id', $record->id)->delete();
                foreach ($arrs as $comm) {
                    $comments = Comments::create([
                        'type' => 1,
                        'name' => $comm,
                        'sign_date' => $date,
                        'ref_id' => $record->id
                    ]);
                }
            }
        }else if($request->setting_type == 2) { //body harm comment
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'name' => 'required'
            ]);

            $record = Bodyharmcomments::where('id', $id)->first();
            if (@$record) {
                $record->name = $request->name;

                $record->update();
            }
        }else if($request->setting_type == 3) { //health care center type
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'title' => 'required'
            ]);

            $record = HealthCareCenterTypes::where('id', $id)->first();
            if (@$record) {
                $record->title = $request->title;

                $record->update();
            }
        }else if($request->setting_type == 4) { //incidence
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'title' => 'required',
                'type' => 'required'
            ]);

            $record = Incidences::where('id', $id)->first();
            if (@$record) {
                $record->title = $request->title;
                $record->type = $request->type;
                $record->content = $request->content;

                $record->update();
            }
        }else if($request->setting_type == 5) { //medication
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'name' => 'required',
                'brand_name' => 'required'
            ]);

            $record = Medications::where('id', $id)->first();
            if (@$record) {
                $record->name = $request->name;
                $record->brand_name = $request->brand_name;
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
        }else if($request->setting_type == 6) { //mood
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'title' => 'required'
            ]);

            $record = Moods::where('id', $id)->first();
            if (@$record) {
                $record->title = $request->title;

                $record->update();
            }
        }else if($request->setting_type == 7) { //relation
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'title' => 'required'
            ]);

            $record = Relations::where('id', $id)->first();
            if (@$record) {
                $record->title = $request->title;

                $record->update();
            }
        }else if($request->setting_type == 8) { //reminder config
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'minutes' => 'required'
            ]);

            $record = ReminderConfigs::where('id', $id)->first();
            if (@$record) {
                $record->minutes = $request->minutes;

                $record->update();
            }
        }else if($request->setting_type == 9) { //representative type
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'title' => 'required'
            ]);

            $record = RepresentativeTypes::where('id', $id)->first();
            if (@$record) {
                $record->title = $request->title;

                $record->update();
            }
        }else if($request->setting_type == 10) { //route
            $this->validate(request(), [
                'template_id' => 'required',
                'setting_type' => 'required',
                'name' => 'required'
            ]);

            $record = Routes::where('id', $id)->first();
            if (@$record) {
                $record->name = $request->name;

                $record->update();
            }
        }else { //settings
            $this->validate(request(), [
                'template_id' => 'required',
                'tab_id' => 'required',
                'fieldName' => 'required',
                'fieldValue' => 'required'
            ]);

            $dates = User::getformattime();
            $date = $dates['date'];

            $field = Fields::where('id', $id)->first();
            $field->fieldName = $request->fieldName;
            $field->tab_id = $request->tab_id;
            $field->update();

            $types = FieldTypes::where('fieldID', $id)->delete();

            foreach ($request->fieldValue as $fv) {
                $fieldtypes = new FieldTypes;

                $fieldtypes->typeName = $fv;
                $fieldtypes->fieldID = $id;
                $fieldtypes->sign_date_field_type = $date;
                $fieldtypes->save();
            }
        }

        return redirect()->route('templates.viewTemplate', $request->template_id);
    }

    /**
     * Update the active status .
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activeReminderconfig($id)
    {
        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();
        
        $result = ReminderConfigs::where('clinic_id', $clinic_id)->whereNotNull('active')->first();
        if (@$result) {
            $result->active = NULL;
            $result->update();
        }

        $record = ReminderConfigs::where('id', $id)->first();
        if (@$record) {
            $record->active = 1;

            $record->update();
        }

        return redirect()->route('templates.viewTemplate', $record->template_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activities = Activities::where('template_id', $id)->delete();
        $bodyharmcomments = Bodyharmcomments::where('template_id', $id)->delete();
        $healthcarecentertypes = HealthCareCenterTypes::where('template_id', $id)->delete();
        $incidences = Incidences::where('template_id', $id)->delete();
        $medications = Medications::where('template_id', $id)->delete();
        $moods = Moods::where('template_id', $id)->delete();
        $relations = Relations::where('template_id', $id)->delete();
        $reminderConfigs = ReminderConfigs::where('template_id', $id)->delete();
        $representativeTypes = RepresentativeTypes::where('template_id', $id)->delete();
        $routes = Routes::where('template_id', $id)->delete();
        $routes = Fields::where('template_id', $id)->delete();

        $record = Templates::where('id', $id)->delete();
        
        return redirect()->route('templates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroysetting($id, $type)
    {
        if($type == 1) {    //activity
            $useractivities = Useractivities::where('activities', $id)->delete();
            $del = Comments::where('type', 1)->where('ref_id', $id)->delete();
            $rec = Activities::where('id', $id)->first();
            $record = Activities::where('id', $id)->delete();
        }else if($type == 2) {    //body harm comment
            $bodyharm = Bodyharms::where('comment', $id)->delete();
            $rec = Bodyharmcomments::where('id', $id)->first();
            $record = Bodyharmcomments::where('id', $id)->delete();
        }else if($type == 3) {    //health care center type
            $centers = HealthCareCenters::where('health_care_center_type', $id)->delete();
            $rec = HealthCareCenterTypes::where('id', $id)->first();
            $record = HealthCareCenterTypes::where('id', $id)->delete();
        }else if($type == 4) {    //incidence
            $rec = Incidences::where('id', $id)->first();
            $record = Incidences::where('id', $id)->delete();
        }else if($type == 5) {    //medication
            $rec = Medications::where('id', $id)->first();
            
            $assignMeds = AssignMedications::where('medications', $id)->get();
            foreach ($assignMeds as $val) {
                $recc = Usermedications::where('assign_id', $val->id)->delete();
            }
            
            $assignMed = AssignMedications::where('medications', $id)->delete();
            $del = Comments::where('type', 2)->where('ref_id', $id)->delete();
            $record = Medications::where('id', $id)->delete();
        }else if($type == 6) {    //mood
            $MoodChanges = MoodChanges::where('mood', $id)->delete();
            $rec = Moods::where('id', $id)->first();
            $record = Moods::where('id', $id)->delete();
        }else if($type == 7) {    //relation
            $familyvisit = FamilyVisits::where('relation', $id)->delete();
            $rec = Relations::where('id', $id)->first();
            $record = Relations::where('id', $id)->delete();
        }else if($type == 8) {    //reminder config
            $rec = ReminderConfigs::where('id', $id)->first();
            $record = ReminderConfigs::where('id', $id)->delete();
        }else if($type == 9) {    //representative type
            $representatives = Representatives::where('representative_type', $id)->delete();
            $rec = RepresentativeTypes::where('id', $id)->first();
            $record = RepresentativeTypes::where('id', $id)->delete();
        }else if($type == 10) {    //route
            $rec = Routes::where('id', $id)->first();
            $record = Routes::where('id', $id)->delete();
        }else{  //settings
            $rec = Fields::where('id', $id)->first();
            $fieldtypes = FieldTypes::where('fieldID', $id)->delete();
            $fields = Fields::where('id', $id)->delete();
        }
            
        return redirect()->route('templates.viewTemplate', $rec->template_id);
    }

    public function importCSVAdmin(Request $request)
    {
        $customerArr = $this->csvToArray($request->file);

        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();
        $template_id = $request->template_id;

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            $medications = Medications::create([
                'name' => $customerArr[$i][0],
                'brand_name' => $customerArr[$i][1],
                'clinic_id' => $clinic_id,
                'sign_date' => $date,
                'template_id' => $template_id
            ]);
        }

        return redirect()->route('templates.viewTemplate', $request->template_id);
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = $row;
            }
            fclose($handle);
        }

        return $data;
    }
}
