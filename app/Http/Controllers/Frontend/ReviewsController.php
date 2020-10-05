<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Quotes;
use App\Reviews;
use App\Product;
use App\Requests;
use App\Purchaseorders;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'purchase_id'        => 'required',
            'mark'        => 'required',
            'description'       => 'required',
        ]);

        if (@$request) {
            $review = Reviews::create([
              'putter'     => auth()->id(),
              'receiver'     => request('receiver'),
              'purchase_id'     => request('purchase_id'),
              'mark'        => request('mark'),
              'description' => request('description'),
              'sign_date'     => date('y-m-d h:i:s'),
            ]);

            return redirect()->route('purchaseorders.viewreview', $request->purchase_id);
        }
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
            $userid = auth()->id();
            $username = User::where('id', $id)->first();
            $name = $username->name;
            $company = $username->company_name;
            $company_logo = $username->company_logo;

            if(auth()->user()->hasRole('seller') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager')) {
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
            }

            if (auth()->user()->hasRole('buyer')) {
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
            }
            
            $products = Product::all();

            return view('frontend.purchaseorders.userreview', compact('products', 'reviews', 'name', 'company', 'company_logo'));
        }
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
