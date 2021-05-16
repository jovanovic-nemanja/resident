<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Reports;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
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
        $reports = Reports::whereDate('created_at', Carbon::today())->get();
        $nurses = DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', 2)
                        ->select('users.*')
                        ->get();
        $active = [];

        return view('admin.reports.index', compact('reports', 'nurses', 'active'));
    }

    /**
     * Return filtered reports data by ajax.
     * @author Nemanja
     * @since 2021-05-16
     * @return \Illuminate\Http\Response
     */
    public function indexbyfilter(Request $request)
    {
        $query = Reports::whereDate('created_at', Carbon::today());
        if(@$request->type) {
            $query = $query->where('type', $request->type);
        }
        if(@$request->user_id) {
            $query = $query->where('user_id', $request->user_id);
        }

        $reports = $query->get();
        $nurses = DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', 2)
                        ->select('users.*')
                        ->get();
        
        $active['typeID'] = ($request->type) ? $request->type : "";
        $active['user_id'] = $request->user_id;

        return view('admin.reports.index', compact('reports', 'nurses', 'active'));
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
        //
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
        $record = Reports::where('id', $id)->delete();
        
        return redirect()->route('reports.index');
    }
}
