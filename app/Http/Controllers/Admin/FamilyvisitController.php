<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Relations;
use App\FamilyVisits;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FamilyvisitController extends Controller
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
    public function indexfamilyvisit($resident)
    {
        $familyvisits = FamilyVisits::where('resident', $resident)->get();

        return view('admin.familyvisits.index', compact('familyvisits', 'resident'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createfamilyvisit($resident)
    {
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $relations = Relations::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $relations = Relations::where('clinic_id', $clinic_id)->get();

        }

        return view('admin.familyvisits.create', compact('relations', 'resident'));
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
            'relation' => 'required',
            'comment' => 'required'
        ]);

        DB::beginTransaction();

        $dates = User::getformattime();
        $date = $dates['date'];

        try {
            $familyvisit = FamilyVisits::create([
                'resident' => $request['resident'],
                'relation' => $request['relation'],
                'comment' => $request['comment'],
                'sign_date' => $date,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('familyvisit.indexfamilyvisit', $request->resident)->with('flash', 'Successfully added family visit list.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = FamilyVisits::where('id', $id)->first();

        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $relations = Relations::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $relations = Relations::where('clinic_id', $clinic_id)->get();

        }

        return view('admin.familyvisits.edit', compact('result', 'relations'));
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
            'relation' => 'required',
            'comment' => 'required'
        ]);

        $record = FamilyVisits::where('id', $id)->first();
        if (@$record) {
            $record->relation = $request->relation;
            $record->comment = $request->comment;

            $record->update();
        }

        $dates = User::getformattime();
        $date = $dates['date'];

        return redirect()->route('familyvisit.indexfamilyvisit', $record->resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rec = FamilyVisits::where('id', $id)->first();
        $record = FamilyVisits::where('id', $id)->delete();
        
        return redirect()->route('familyvisit.indexfamilyvisit', $rec->resident);
    }
}
