<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use App\Adminlogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
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
        $categories = Unit::all();
        return view('admin.unit.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unit = Unit::create([
            'name' => $request->name,
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        $data = [];
        $data['title'] = 'Added';
        $data['description'] = 'Unit Name: '.$request->name;
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('unit.index')->with('flash', 'Unit has been successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->name = $request->name;
        $unit->save();

        $data = [];
        $data['title'] = 'Updated';
        $data['description'] = 'Unit Name: '.$request->name;
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('unit.index')->with('flash', 'Unit has successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        $data = [];
        $data['title'] = 'Deleted';
        $data['description'] = 'Unit Name: '.$unit['name'];
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('unit.index')->with('flash', 'Unit has successfully deleted');
    }
}
