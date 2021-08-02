<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Moods;
use App\Routes;
use App\Relations;
use App\Templates;
use App\Activities;
use App\Incidences;
use App\Medications;
use App\ReminderConfigs;
use App\Bodyharmcomments;
use App\RepresentativeTypes;
use App\HealthCareCenterTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
                $record->name = $templateID;
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

            return view('admin.templates.create', compact('template', 'activities', 'comments', 'healthcarecentertypes', 'incidences', 'medications', 'moods', 'relations', 'reminderconfigs', 'types', 'routes'));
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
    public function createactivity()
    {
        return view('admin.templates.createactivity');
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
            'title' => 'required',
            'type' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        $activities = Templates::create([
            'title' => $request->title,
            'clinic_id' => $clinic_id,
            'type' => $request->type,
            'comments' => $request->comments,
            'sign_date' => $date,
        ]);

        return redirect()->route('templates.index')->with('flash', 'Activity has been successfully created.');
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
            'title' => 'required',
            'type' => 'required'
        ]);

        $record = Templates::where('id', $id)->first();
        if (@$record) {
            $record->title = $request->title;
            $record->type = $request->type;
            $record->comments = $request->comments;

            $record->update();
        }

        $dates = User::getformattime();
        $date = $dates['date'];

        return redirect()->route('templates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Templates::where('id', $id)->delete();
        
        return redirect()->route('templates.index');
    }
}
