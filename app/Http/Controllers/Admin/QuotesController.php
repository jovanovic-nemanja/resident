<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Quotes;
use App\Adminlogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuotesController extends Controller
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
        $quotes = Quotes::all();

        $tt = array();
        if (@$quotes) {
            foreach ($quotes as $quote) {
                $id = $quote->request_id;
                $tt[$id][] = $quote;
            }
        }

        $total = array_reverse($tt);

        $user = User::all();
        
        return view('admin.quotes.index', compact('total', 'user', 'quotes'));
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
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $record = Quotes::where('id', $id)->get();

            if (@$record) {
                $name = $record[0]->product_name;
                if ($record[0]->status == NULL || $record[0]->status == 1) {
                    $record[0]->status = 2;
                    $record[0]->update();

                    return redirect()->route('quotes.index')->with('flash', 'The Quote: "'.$name.'" has been approved.');
                }else{
                    $record[0]->status = 1;
                    $record[0]->update();

                    return redirect()->route('quotes.index')->with('flash', 'The Quote: "'.$name.'" has been reviewed.');
                }
            }else{
                return back();
            }
            
        }else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $res = Quotes::where('id', $id)->first();
            $record = Quotes::where('id', $id)->delete();

            $data = [];
            $data['title'] = 'Deleted';
            $data['description'] = 'Quote Name: '.$res->product_name;
            $add_logs = Adminlogs::Addlog($data);

            return redirect()->route('quotes.index')->with('flash', 'Quote has successfully deleted');
        }else{
            return back();
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotes $quotes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotes $quotes)
    {
        //
    }
}
