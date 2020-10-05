<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Adminlogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManagesellersController extends Controller
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
        $categories = User::all();
        return view('admin.managesellers.index', compact('categories'));
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
        if (@$id) {
            $records = User::where('id', $id)->get();
            if (@$records) {
                $records[0]['block'] = 0;
                $records[0]->update();

                $data = [];
                $data['title'] = 'Un-Blocked';
                $data['description'] = 'Seller Name: '.$records[0]['name'];
                $add_logs = Adminlogs::Addlog($data);

                return redirect()->route('managesellers.index')->with('flash', 'Seller has been successfully changed the status.');
            }
        }else{
            return redirect()->route('managesellers.index');
        }  
    }

    /**
     * User Block feature.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $records = User::where('id', $id)->get();
            if (@$records) {
                $records[0]['block'] = 1;
                $records[0]->update();

                $data = [];
                $data['title'] = 'Blocked';
                $data['description'] = 'Seller Name: '.$records[0]['name'];
                $add_logs = Adminlogs::Addlog($data);

                return redirect()->route('managesellers.index')->with('flash', 'Seller has been successfully changed the status.');
            }
        }else{
            return redirect()->route('managesellers.index');
        }        
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
        //
    }
}
