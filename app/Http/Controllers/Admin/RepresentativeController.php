<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Representatives;
use App\RepresentativeTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RepresentativeController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth', 'manager']);
    }

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
    public function indexrepresentative($resident)
    {
        $representatives = Representatives::where('user_id', $resident)->get();
        $user = User::where('id', $resident)->first();

        return view('admin.representatives.index', compact('representatives', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createrepresentative($resident)
    {
        $user = User::where('id', $resident)->first();
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $types = RepresentativeTypes::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $types = RepresentativeTypes::where('clinic_id', $clinic_id)->get();

        }

        return view('admin.representatives.create', compact('types', 'user', 'resident'));
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
            'representative_type' => 'required',
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'street1' => 'required|string|max:191',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required'
        ]);
        
        DB::beginTransaction();

        $dates = User::getformattime();
        $date = $dates['date'];

        try {
            $representative = Representatives::create([
                'firstname' => $request['firstname'],
                'user_id' => $request['resident'],
                'lastname' => $request['lastname'],
                'representative_type' => $request['representative_type'],
                'street1' => $request['street1'],
                'street2' => @$request['street2'],
                'city' => $request['city'],
                'zip_code' => $request['zip_code'],
                'state' => $request['state'],
                'home_phone' => @$request['home_phone'],
                'cell_phone' => @$request['cell_phone'],
                'sign_date' => $date,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }  

        return redirect()->route('representative.indexrepresentative', $request['resident'])->with('flash', 'Successfully added new representative info.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $representative = Representatives::where('id', $id)->first();
        $result = [];
        $result['representative'] = $representative;
        $result['user'] = User::where('id', $representative->user_id)->first();
        
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $types = RepresentativeTypes::where('clinic_id', $clinic_id)->get();

        }else if(auth()->user()->hasRole('care taker')) {

            $user_id = auth()->id();
            $user = User::where('id', $user_id)->first();
            $clinic_id = $user->clinic_id;
            $types = RepresentativeTypes::where('clinic_id', $clinic_id)->get();

        }
        $result['types'] = $types;

        return view('admin.representatives.edit', compact('result'));
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
            'representative_type' => 'required',
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'street1' => 'required|string|max:191',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $time = $dates['time'];

        $record = Representatives::where('id', $id)->first();
        $resident = $record->user_id;
        if (@$record) {
            $record->representative_type = $request->representative_type;
            $record->firstname = $request->firstname;
            $record->lastname = $request->lastname;
            $record->street1 = $request->street1;
            $record->street2 = @$request->street2;
            $record->city = $request->city;
            $record->zip_code = $request->zip_code;
            $record->state = $request->state;
            $record->home_phone = @$request->home_phone;
            $record->cell_phone = @$request->cell_phone;

            $record->update();
        }

        return redirect()->route('representative.indexrepresentative', $resident);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rec = Representatives::where('id', $id)->first();
        $record = Representatives::where('id', $id)->delete();
        
        return redirect()->route('representative.indexrepresentative', $rec->user_id);
    }
}
