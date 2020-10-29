<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Bodyharms;
use App\Bodyharmcomments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BodyharmController extends Controller
{
    public function __construct(){
        // $this->middleware(['auth', 'admin']);
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
    public function indexbodyharm($id)
    {
        $bodyharms = Bodyharms::where('resident', $id)->get();
        $user = User::where('id', $id)->first();

        return view('admin.bodyharm.index', compact('bodyharms', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createbodyharm($resident)
    {
        $resident = $resident;

        return view('admin.bodyharm.create', compact('resident'));
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
            'comment' => 'required',
            'screenshot_3d' => 'required'
        ]);

        $dates = User::getformattime();
        $date = $dates['date'];
        $time = $dates['time'];

        $bodyharm = Bodyharms::create([
            'resident' => $request->resident,
            'comment' => $request->comment,
            'screenshot_3d' => $request->screenshot_3d,
            'sign_date' => $date,
        ]);

        Bodyharms::upload_file($bodyharm->id);

        return redirect()->route('bodyharm.indexbodyharm', $request->resident)->with('flash', 'Body harm has been successfully created.');
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
        $resident = Bodyharms::where('id', $id)->first();
        $record = Bodyharms::where('id', $id)->delete();
        
        return redirect()->route('bodyharm.indexbodyharm', $resident->resident);
    }
}
