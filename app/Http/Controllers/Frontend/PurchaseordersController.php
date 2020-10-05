<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Quotes;
use App\Product;
use App\Reviews;
use App\Requests;
use App\Comments;
use App\Purchaseorders;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PurchaseordersController extends Controller
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
        $userid = auth()->id();
        if(auth()->user()->hasRole('seller')) {
            $quotes = DB::table('quotes')
                            ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                            ->where('quotes.sender', $userid)
                            ->where('purchase_orders.payment_status', '!=', 3)
                            ->whereNull('quotes.deleted_at')
                            ->select('quotes.*', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                            ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                            ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                            ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                            ->Join('users', 'users.id', '=', 'quotes.sender')
                            ->where('purchase_orders.payment_status', '!=', 3)
                            ->where('quotes.status', 2)
                            ->where('requests.sender', $userid)
                            ->whereNull('quotes.deleted_at')
                            ->select('quotes.*', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name')
                            ->get();
        }
        
        $products = Product::all();

        return view('frontend.purchaseorders.index', compact('products', 'quotes'));
    }

    /**
     * Display a listing of the resource when payment status is 3.
     *
     * @return \Illuminate\Http\Response
     */
    public function completedorders()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userid = auth()->id();
        if(auth()->user()->hasRole('seller')) {
            $quotes = DB::table('quotes')
                            ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                            ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                            ->Join('users', 'users.id', '=', 'requests.sender')
                            ->where('quotes.sender', $userid)
                            ->where('purchase_orders.payment_status', 3)
                            ->whereNull('quotes.deleted_at')
                            ->select('quotes.*', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name', 'requests.sender as buyer_id')
                            ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                            ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                            ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                            ->Join('users', 'users.id', '=', 'quotes.sender')
                            ->where('quotes.status', 2)
                            ->where('purchase_orders.payment_status', 3)
                            ->where('requests.sender', $userid)
                            ->whereNull('quotes.deleted_at')
                            ->select('quotes.*', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name')
                            ->get();
        }

        $reviews = Reviews::all();
        $products = Product::all();

        return view('frontend.purchaseorders.completedorders', compact('products', 'quotes', 'reviews'));
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
     * Payment status change page render
     *
     * @param  int  $id------purchase_orders table id
     * @return \Illuminate\Http\Response
     */
    public function paymentchange($id)
    {
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();

            return view('frontend.purchaseorders.paymentchange', compact('record'));
        }
    }    

    /**
     * Add Review page render
     *
     * @param  int  $id------purchase_orders table id
     * @return \Illuminate\Http\Response
     */
    public function addreview($id)
    {
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();

            $userid = auth()->id();
            $username = User::where('id', $id)->first();
            $company = $username->company_name;

            if(auth()->user()->hasRole('seller')) {
                $quotes = DB::table('quotes')
                                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                                ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                                ->Join('users', 'users.id', '=', 'requests.sender')
                                ->where('purchase_orders.id', $id)
                                ->select('requests.sender', 'users.name as username')
                                ->get();
            }
            if (auth()->user()->hasRole('buyer')) {
                $quotes = DB::table('quotes')
                                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                                ->Join('users', 'users.id', '=', 'quotes.sender')
                                ->where('purchase_orders.id', $id)
                                ->select('quotes.sender', 'users.name as username')
                                ->get();
            }

            return view('frontend.purchaseorders.addreview', compact('record', 'quotes', 'company'));
        }
    }    

    public function viewreview($id)
    {
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();

            $userid = auth()->id();
            $record = Reviews::where('purchase_id', $id)->where('putter', $userid)->first();
            $receiver_id = $record->receiver;
            $receiver_record = Reviews::where('purchase_id', $id)->where('putter', $receiver_id)->first();
            $putter = User::where('id', $userid)->first();
            $receiver = User::where('id', $receiver_id)->first();

            return view('frontend.purchaseorders.viewreview', compact('record', 'receiver_record', 'putter', 'receiver'));
        }
    }    

    /**
     * Update the specified resource in storage. (Payment status change function)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate(request(), [
            'payment_information' => 'required',
        ]);

        if (@$request->id) {
            $id = $request->id;
            $record = Purchaseorders::where('id', $id)->first();
            switch ($record->payment_status) {
                case '1':
                    $record->payment_information = $request->payment_information;
                    $record->payment_status = 2;
                    break;
                case '2':
                    $record->payment_information = $request->payment_information;
                    $record->payment_status = 3;
                    break;

                default:
                    # code...
                    break;
            }

            $record->update();
        }

        return redirect()->route('purchaseorders.index');
    }

    /**
     * view comments page
     * 
     * @param int $id -> purchase orders table id
    */
    public function comments($id)
    {
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();
            if (@$record) {
                $id = $record->id;
                $comments = Comments::where('purchase_id', $record->id)->orderBy('comments.id', 'desc')->get();
                $url = route('purchaseorders.getcomments', $id);
                return view('frontend.purchaseorders.comments', compact('record', 'comments', 'url'));
            }
        }
    }

    /**
     * response ajax data comment 
     * 
     * @param int $id -> purchase orders table id
    */
    public function getcomments($id)
    {
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();
            if (@$record) {
                $comments = DB::table('comments')
                                ->Join('users', 'users.id', '=', 'comments.writer')
                                ->where('comments.purchase_id', $record->id)
                                ->orderBy('comments.id', 'desc')
                                ->select('comments.description', 'comments.sign_date', 'users.name as username')
                                ->get();

                return response()->json($comments);
            }
        }
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
