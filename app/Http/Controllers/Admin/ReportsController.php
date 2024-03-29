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
        $this->middleware(['auth', 'manager']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->id();
        $reports = Reports::where('clinic_id', $user_id)->whereDate('created_at', Carbon::today())->get();
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
        if(@$request->duration) {
            switch ($request->duration) {
                case '1':   //Today
                    $query = Reports::whereDate('created_at', Carbon::today());
                    break;
                case '2':   //Yesterday
                    $query = Reports::whereDate('created_at', Carbon::yesterday());
                    break;
                case '3':   //Week
                    $query = Reports::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;    
                case '4':   //Month
                    $query = Reports::whereMonth('created_at', Carbon::now()->format('m'));
                    break;   
                case '5':   //Range start and end date
                    $start = $request->start;
                    $end = $request->end;
                    $query = Reports::whereBetween('created_at', [$start." 00:00:00", $end." 23:59:59"]);
                    break;   

                default:
                    $query = Reports::whereDate('created_at', Carbon::today());
                    break;
            }
            
        }else{
            $query = Reports::whereNotNull('created_at');
        }
        
        if(@$request->type) {
            $query = $query->where('type', $request->type);
        }
        if(@$request->user_id) {
            $query = $query->where('user_id', $request->user_id);
        }

        $clinic_id = auth()->id();
        $reports = $query->where('clinic_id', $clinic_id)->get();
        $nurses = DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', 2)
                        ->select('users.*')
                        ->get();
        
        $active['typeID'] = ($request->type) ? $request->type : "";
        $active['user_id'] = $request->user_id;
        $active['durations'] = $request->duration;

        return view('admin.reports.index', compact('reports', 'nurses', 'active'));
    }

    /**
     * Display a listing of the resource.
     * 
     * @author Nemanja
     * @since 2021-05-17
     * @return \Illuminate\Http\Response
     */
    public function indexresident($resident)
    {
        $resident_id = $resident;
        $reports = Reports::where('resident_id', $resident)->whereDate('created_at', Carbon::today())->get();
        $nurses = DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', 2)
                        ->select('users.*')
                        ->get();
        $resident = User::where('id', $resident)->first();
        
        $active = [];

        return view('admin.reports.indexresident', compact('reports', 'nurses', 'active', 'resident', 'resident_id'));
    }

    /**
     * Return filtered reports data by ajax.
     * @author Nemanja
     * @since 2021-05-17
     * @return \Illuminate\Http\Response
     */
    public function indexresidentbyfilter(Request $request)
    {
        if(@$request->duration) {
            switch ($request->duration) {
                case '1':   //Today
                    $query = Reports::whereDate('created_at', Carbon::today());
                    break;
                case '2':   //Yesterday
                    $query = Reports::whereDate('created_at', Carbon::yesterday());
                    break;
                case '3':   //Week
                    $query = Reports::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;    
                case '4':   //Month
                    $query = Reports::whereMonth('created_at', Carbon::now()->format('m'));
                    break;   
                case '5':   //Range start and end date
                    $start = $request->start;
                    $end = $request->end;
                    $query = Reports::whereBetween('created_at', [$start." 00:00:00", $end." 23:59:59"]);
                    break;   

                default:
                    $query = Reports::whereDate('created_at', Carbon::today());
                    break;
            }
            
        }else{
            $query = Reports::whereNotNull('created_at');
        }
        
        if(@$request->type) {
            $query = $query->where('type', $request->type);
        }
        if(@$request->user_id) {
            $query = $query->where('user_id', $request->user_id);
        }

        $reports = $query->where('resident_id', $request->resident)->get();
        $nurses = DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', 2)
                        ->select('users.*')
                        ->get();
        
        $active['typeID'] = ($request->type) ? $request->type : "";
        $active['user_id'] = $request->user_id;
        $active['durations'] = $request->duration;
        $resident_id = $request->resident;
        $resident = User::where('id', $resident_id)->first();

        return view('admin.reports.indexresident', compact('reports', 'nurses', 'active', 'resident_id', 'resident'));
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
