<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Switchreminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SwitchreminderController extends Controller
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
        $result = Switchreminder::where('clinic_id', $clinic_id)->first();

        return view('admin.switchreminder.index', compact('result'));
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
        $dates = User::getformattime();
        $date = $dates['date'];
        $clinic_id = auth()->id();

        $record = Switchreminder::create([
            'status' => 1,
            'clinic_id' => $clinic_id,
            'set_time' => $date,
        ]);

        return redirect()->route('switchreminder.index')->with('flash', 'Reminder has been successfully disabled.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $record = Switchreminder::where('id', $id)->delete();
        
        return redirect()->route('switchreminder.index');
    }
}
