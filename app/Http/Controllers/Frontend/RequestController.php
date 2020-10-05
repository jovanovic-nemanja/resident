<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use App\User;
use App\Files;
use App\Requests;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Frontend\EmailsController;

class RequestController extends Controller
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
        if(auth()->user()->hasRole('buyer')) {
            $requests = Requests::where('sender', $userid)->get();
        }
        if (auth()->user()->hasRole('seller')) {
            $query = "JSON_CONTAINS(receiver, ".$userid.", '$')=1";

            $requests = Requests::whereRaw($query)->where('status', 2)->get();
            // $requests = Requests::whereJsonContains('receiver', $userid)->where('status', 2)->get();
        }
        
        $products = Product::all();

        return view('frontend.request.index', compact('products', 'requests'));
    }

    /**
     * Show the form for sending a new request.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id = null)
    {
        if (auth()->user()->hasRole('buyer')) {
            if (@$product_id) { //when buyer click the product directly
                $product = Product::where('id', $product_id)->get();
            }else{  //when buyer didn't click any product.
                $product = [];
            }

            return view('frontend.request.create', compact('product'));
        } 

        if (auth()->user()->hasRole('seller')) {
            return redirect()->route('sellerdashboard.index');
        }
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard.index');
        }
        if (auth()->user()->hasRole('manager')) {
            return redirect()->route('managesellers.index');
        }
    }

    /**
     * Show the form for editing the sent request.
     *
     * @return \Illuminate\Http\Response
     */
    public function change($request_id = null)
    {
        if (@$request_id) { //when buyer click the product directly
            $request = Requests::where('id', $request_id)->get();
            $product_id = $request[0]->product_id;
            if (@$product_id) {
                $product = Product::where('id', $product_id)->get();    
            }else{
                $product = null;
            }
        }

        return view('frontend.request.change', compact('request', 'product'));
    }

    /**
     * Show the form for viewing the sent request.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($request_id = null)
    {
        if (@$request_id) { //when buyer click the product directly
            $request = Requests::where('id', $request_id)->get();
            $product_id = $request[0]->product_id;
            if (@$product_id) {
                $product = Product::where('id', $product_id)->first();    
            }else{
                $product = null;
            }
        }

        return view('frontend.request.view', compact('request', 'product'));
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
            'product_name'        => 'required',
            'volume'       => 'required',
            'port_of_destination' => 'required',
            'description' => 'required',
        ]);

        $userid = auth()->id();
        $user = User::where('id', $userid)->first();
        $username = $user->name;
        $useremail = $user->email;

        if (request('type') == -1) {   //when buyer didn't choose any product and send the rfq.
            $rfq = Requests::create([
                'product_name'           => request('product_name'),
                'additional_information' => request('description'),
                'sender'                 => auth()->id(),
                'volume'                 => request('volume'),
                'unit'                   => request('unit'),
                'port_of_destination'    => request('port_of_destination'),
                'receiver'               => null,
                'status'                 => 1,
                'sign_date'              => date('y-m-d h:i:s'),
            ]);

            $files = Files::upload_file_rfq($rfq['id']);
        }else{ //when buyer choose any product and send the rfq.
            $product = Product::where('name', request('product_name'))->get();
            
            if(@$product) {
                $receiver = $product[0]->user_id;
                $product_id = $product[0]->id;
            }

            $rfq = Requests::create([
                'product_name'           => request('product_name'),
                'additional_information' => request('description'),
                'sender'                 => auth()->id(),
                'volume'                 => request('volume'),
                'product_id'                 => $product_id,
                'unit'                   => request('unit'),
                'port_of_destination'    => request('port_of_destination'),
                'receiver'               => '['.$receiver.']',
                'status'                 => 1,
                'sign_date'              => date('y-m-d h:i:s'),
            ]);

            $files = Files::upload_file_rfq($rfq['id']);
        }

        $controller = new EmailsController;
        $array = [];
        $array['username'] = $username;
        $array['receiver_address'] = $useremail;
        $array['data'] = array('name' => $array['username'], "body" => "Thanks for your RFQ has been recieved. It will be reviewed and approved.");
        $array['subject'] = "Successfully received your RFQ.";
        $array['sender_address'] = "jovanovic.nemanja.1029@gmail.com";

        $controller->save($array);

        return redirect()->route('request.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $requests)
    {
        $this->validate(request(), [
            'product_name'        => 'required',
            'volume'       => 'required',
            'port_of_destination' => 'required',
            'description' => 'required',
        ]);

        if(@request('id')) {
            $records = Requests::where('id', request('id'))->get();
        }
            
        $records[0]->additional_information = request('description');
        $records[0]->volume = request('volume');
        $records[0]->unit = request('unit');
        $records[0]->port_of_destination = request('port_of_destination');
        $records[0]->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        $record = Requests::where('id', request('id'))->get();
        if(@$record) {
            $record[0]->status = 3;
            $record[0]->update();
        }

        return back();
    }
}
