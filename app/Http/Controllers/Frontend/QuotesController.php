<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Quotes;
use App\Product;
use App\Requests;
use App\Purchaseorders;
use App\Achievedquotes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuotesController extends Controller
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
            $query = "JSON_CONTAINS(requests.receiver, ".$userid.", '$')=1";

            $quotes = DB::table('quotes')
                            ->leftJoin('requests', 'requests.id', '=', 'quotes.request_id')
                            // ->Join('users', 'users.id', '=', 'quotes.sender')
                            ->whereRaw($query)
                            ->where('quotes.sender', $userid)
                            ->whereNull('quotes.deleted_at')
                            ->select('quotes.*', 'requests.*', 'requests.sign_date as re_sign_date', 'quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id')
                            ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                            ->select('quotes.*', 'requests.*', 'requests.sign_date as re_sign_date', 'quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id', 'users.name as username', 'users.company_name', 'quotes.sender as seller_id')
                            ->leftJoin('requests', 'requests.id', '=', 'quotes.request_id')
                            ->Join('users', 'users.id', '=', 'quotes.sender')
                            ->where('requests.sender', $userid)
                            ->where('quotes.status', 2)
                            ->whereNull('quotes.deleted_at')                            
                            ->get();
        }
        
        $total = array();
        if (@$quotes) {
            foreach ($quotes as $quote) {
                $id = $quote->request_id;
                $main_id = $quote->main_id;
                
                $purchaseorders = Purchaseorders::where('request_id', $main_id)->first();
                $achievedquotes = Achievedquotes::where('request_id', $main_id)->first();

                if (@$purchaseorders) {
                    # code...
                }else{
                    if (@$achievedquotes) {
                        # code...
                    }else{
                        $total[$id][] = $quote;        
                    }
                }
            }
        }

        $products = Product::all();
        $t_quotes = Quotes::all();
        $user = User::all();

        return view('frontend.quotes.index', compact('products', 'total', 'user', 't_quotes'));
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

    public function reply($id)
    {
        if (@$id) {
            $data = [];
            $records = Requests::where('id', $id)->get();
            if (@$records) {
                $data['product_name'] = $records[0]->product_name;
                if (@$records[0]->unit) {
                    $data['unit'] = $records[0]->unit;
                }else{
                    $data['unit'] = 1;    
                }
                
                $data['volume'] = $records[0]->volume;
                $data['readonly'] = "readonly";
                $data['request_id'] = $id;

                return view('frontend.quotes.new', compact('data'));
            }
        }
    }

    public function accepted($id)
    {
        if (@$id) {
            $records = Quotes::where('id', $id)->get();
            if (@$records) {
                $quotes_id = $records[0]->id;
                $payment_status = 1;
                $payment_information = "Payment Pending";

                $purchaseorders = Purchaseorders::where('request_id', $quotes_id)->first();
                if (@$purchaseorders) {
                    
                }else{
                    $product = Purchaseorders::create([
                        'request_id' => $quotes_id,
                        'payment_status' => $payment_status,
                        'payment_information' => $payment_information,
                        'sign_date' => date('y-m-d h:i:s'),
                    ]);
                }

                return redirect()->route('purchaseorders.index');
            }
        }
    }

    public function reject($id)
    {
        if (@$id) {
            $records = Quotes::where('id', $id)->get();
            if (@$records) {
                $quotes_id = $records[0]->id;

                $product = Achievedquotes::create([
                    'request_id' => $quotes_id,
                    'sign_date' => date('y-m-d h:i:s'),
                ]);

                return redirect()->route('achievedquotes.index');
            }
        }
    }

    public function change($id)
    {
        if (@$id) {
            $data = [];
            $records = Quotes::where('id', $id)->get();

            $result = $records[0];
            $seller = User::where('id', $result->sender)->first();
            $result['readonly'] = "";

            return view('frontend.quotes.edit', compact('result', 'seller'));
        }
    }

    public function detailview($id)
    {
        if (@$id) {
            $data = [];
            $records = Quotes::where('id', $id)->get();
            $request_id = $records[0]['request_id'];
            $product = Requests::where('id', $request_id)->get();

            $result = $records[0];
            $seller = User::where('id', $result->sender)->first();
            $result['product_name'] = $product[0]->product_name;
            $result['volume'] = $product[0]->volume;
            $result['unit'] = $product[0]->unit;
            $result['readonly'] = "readonly";

            $purchaseorders = Purchaseorders::where('request_id', $id)->get();
            if (@$purchaseorders[0]) {
                $result['purchase'] = $purchaseorders[0];
            }else{
                $achieves = Achievedquotes::where('request_id', $id)->get();
                if (@$achieves[0]) {
                    $result['purchase'] = $achieves[0];
                }else{
                    $result['purchase'] = "";
                }
            }

            return view('frontend.quotes.edit', compact('result', 'seller'));
        }
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
            'request_id'        => 'required'
        ]);

        $userid = auth()->id();

        if (request('available') != 'on') { //alternative product case
            $rfq = Quotes::create([
                'request_id' => request('request_id'),
                'product_name' => request('product_name'),
                'product_price'       => 0,
                'sender'       => $userid,
                'volume' => request('volume'),
                'unit' => request('unit'),
                'alternative_product' => request('alternative_product'),
                'alternative_product_price' => request('alternative_product_price'),
                'shipping_price' => request('shipping_price'),
                'shipping_weight' => request('shipping_weight'),
                'shipping_unit' => request('shipping_unit'),
                'shipping_desc' => request('shipping_desc'),
                'other_price' => request('other_price'),
                'other_price_desc' => request('other_price_desc'),
                'available' => 1,
                'total_price' => request('total_price'),
                'status' => 2,
                'sign_date'     => date('y-m-d h:i:s'),
            ]);
        }else{
            $rfq = Quotes::create([
                'request_id'        => request('request_id'),
                'product_name' => request('product_name'),
                'volume' => request('volume'),
                'sender'       => $userid,
                'unit' => request('unit'),
                'product_price'       => request('product_price'),
                'alternative_product_price' => 0,
                'shipping_price' => request('shipping_price'),
                'shipping_weight' => request('shipping_weight'),
                'shipping_unit' => request('shipping_unit'),
                'shipping_desc' => request('shipping_desc'),
                'other_price' => request('other_price'),
                'other_price_desc' => request('other_price_desc'),
                'available' => 0,
                'total_price' => request('total_price'),
                'status' => 2,
                'sign_date'     => date('y-m-d h:i:s'),
            ]);
        }
            
        return redirect()->route('quote.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function show(Quotes $quotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotes $quotes)
    {
        //
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
        $this->validate(request(), [
            'request_id'        => 'required'
        ]);

        if(@request('id')) {
            $records = Quotes::where('id', request('id'))->get();

            if (request('available') != 'on') { //alternative product case
                $records[0]->alternative_product = request('alternative_product');
                $records[0]->alternative_product_price = request('alternative_product_price');

                $records[0]->shipping_price = request('shipping_price');
                $records[0]->shipping_desc = request('shipping_desc');
                
                $records[0]->other_price = request('other_price');
                $records[0]->other_price_desc = request('other_price_desc');
                
                $records[0]->available = 1;
                
                $records[0]->total_price = request('total_price');

                $records[0]->update();
            }else{
                $records[0]->shipping_price = request('shipping_price');
                $records[0]->shipping_desc = request('shipping_desc');
                $records[0]->other_price = request('other_price');
                $records[0]->other_price_desc = request('other_price_desc');
                $records[0]->available = 0;
                $records[0]->total_price = request('total_price');

                $records[0]->product_price = request('product_price');
                $records[0]->update();
            }
        }

        return redirect()->route('quote.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotes $quotes)
    {
        $record = Quotes::where('id', request('id'))->get();
        if(@$record) {
            $record[0]->status = 3;
            $record[0]->update();
        }

        return back();
    }
}
