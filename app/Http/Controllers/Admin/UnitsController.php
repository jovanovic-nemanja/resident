<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Units;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitsController extends Controller
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
        $units = Units::where('clinic_id', $clinic_id)->get();

        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create');
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

        $units = Units::create([
            'title' => $request->title,
            'clinic_id' => $clinic_id,
            'sign_date' => $date,
        ]);

        return redirect()->route('units.index')->with('flash', 'Unit has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Units::where('id', $id)->first();

        return view('admin.units.edit', compact('result'));
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

        $record = Units::where('id', $id)->first();
        if (@$record) {
            $record->title = $request->title;

            $record->update();
        }

        return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Units::where('id', $id)->delete();
        
        return redirect()->route('units.index');
    }
}
