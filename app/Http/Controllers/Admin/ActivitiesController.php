<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Activities;
use App\Useractivities;

class ActivitiesController extends Controller
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
        $activities = Activities::all();

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activities.create');
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

        $activities = Activities::create([
            'title' => $request->title,
            'type' => $request->type,
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        return redirect()->route('activities.index')->with('flash', 'Activity has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Activities::where('id', $id)->first();

        return view('admin.activities.edit', compact('result'));
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

        $record = Activities::where('id', $id)->first();
        if (@$record) {
            $record->title = $request->title;
            $record->type = $request->type;

            $record->update();
        }

        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $useractivities = Useractivities::where('activities', $id)->delete();
        $record = Activities::where('id', $id)->delete();
        
        return redirect()->route('activities.index');
    }
}
