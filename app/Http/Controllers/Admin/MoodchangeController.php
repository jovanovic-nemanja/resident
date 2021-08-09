<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Moods;
use App\MoodChanges;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MoodchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexmoodchange($resident)
    {
        $moodchanges = MoodChanges::where('resident', $resident)->get();

        return view('admin.moodchanges.index', compact('moodchanges', 'resident'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createmoodchange($resident)
    {
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $moods = Moods::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $moods = Moods::where('clinic_id', $clinic_id)->get();

        }

        return view('admin.moodchanges.create', compact('moods', 'resident'));
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
            'resident' => 'required',
            'mood' => 'required',
            'description' => 'required',
            'sign_date' => 'required'
        ]);

        DB::beginTransaction();

        try {
            $moodchange = MoodChanges::create([
                'resident' => $request['resident'],
                'mood' => $request['mood'],
                'description' => $request['description'],
                'sign_date' => $request['sign_date'],
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('moodchange.indexmoodchange', $request->resident)->with('flash', 'Successfully added mood change list.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = MoodChanges::where('id', $id)->first();

        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $moods = Moods::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $moods = Moods::where('clinic_id', $clinic_id)->get();

        }

        return view('admin.moodchanges.edit', compact('result', 'moods'));
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
            'mood' => 'required',
            'description' => 'required',
            'sign_date' => 'required'
        ]);

        $record = MoodChanges::where('id', $id)->first();
        if (@$record) {
            $record->mood = $request->mood;
            $record->description = $request->description;
            $record->sign_date = $request->sign_date;

            $record->update();
        }

        return redirect()->route('moodchange.indexmoodchange', $record->resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rec = MoodChanges::where('id', $id)->first();
        $record = MoodChanges::where('id', $id)->delete();
        
        return redirect()->route('moodchange.indexmoodchange', $rec->resident);
    }
}
