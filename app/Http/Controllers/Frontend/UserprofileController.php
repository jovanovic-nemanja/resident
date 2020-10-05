<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserprofileController extends Controller
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
     * Display the specified user profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        if (@$id) {
            $user = User::where('id', $id)->first();

            $reviews = DB::table('reviews')
                            ->Join('purchase_orders', 'purchase_orders.id', '=', 'reviews.purchase_id')
                            ->Join('quotes', 'quotes.id', '=', 'purchase_orders.request_id')
                            ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                            ->Join('users', 'users.id', '=', 'reviews.putter')
                            ->where('purchase_orders.payment_status', '=', 3)
                            ->where('quotes.status', 2)
                            ->where('reviews.receiver', $id)
                            ->whereNull('quotes.deleted_at')
                            ->select('quotes.product_name as product_name', 'reviews.sign_date', 'quotes.total_price', 'reviews.mark', 'reviews.description', 'users.name')
                            ->get();

            $mark = User::getMarks($id);
        }

        return view('frontend.userprofile.view', compact('user', 'reviews', 'mark'));
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
        //
    }
}
