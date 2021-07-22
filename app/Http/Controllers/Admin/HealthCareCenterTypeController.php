<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\HealthCareCenterTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HealthCareCenterTypeController extends Controller
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
        $clinic_id = auth()->id();
        $types = HealthCareCenterTypes::where('clinic_id', $clinic_id)->get();

        return view('admin.healthcarecentertypes.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.healthcarecentertypes.create');
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
            'title' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        $type = HealthCareCenterTypes::create([
            'title' => $request->title,
            'clinic_id' => $clinic_id,
            'sign_date' => $date,
        ]);

        return redirect()->route('healthcarecentertypes.index')->with('flash', 'Health Care center Type has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = HealthCareCenterTypes::where('id', $id)->first();

        return view('admin.healthcarecentertypes.edit', compact('result'));
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
            'title' => 'required'
        ]);

        $record = HealthCareCenterTypes::where('id', $id)->first();
        if (@$record) {
            $record->title = $request->title;

            $record->update();
        }

        return redirect()->route('healthcarecentertypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = HealthCareCenterTypes::where('id', $id)->delete();
        
        return redirect()->route('healthcarecentertypes.index');
    }
}
