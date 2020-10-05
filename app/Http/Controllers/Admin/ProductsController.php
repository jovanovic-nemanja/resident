<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\User;
use App\Product;
use App\Adminlogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;

class ProductsController extends Controller
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
        $categories = Product::all();
        return view('admin.product.index', compact('categories'));
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
    public function store($id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $record = Product::where('id', $id)->get();
            if (@$record) {
                if ($record[0]->status == NULL || $record[0]->status == 1) {
                    $record[0]->status = 2;
                    $record[0]->update();

                    $data = [];
                    $data['title'] = 'Approved';
                    $data['description'] = 'Product Name: '.$record[0]->name;
                    $add_logs = Adminlogs::Addlog($data);

                    $userid = $record[0]->user_id;
                    $user = User::where('id', $userid)->first();
                    $username = $user->name;
                    $useremail = $user->email;

                    $controller = new EmailsController;
                    $array = [];
                    $array['username'] = $username;
                    $array['receiver_address'] = $useremail;
                    $array['data'] = array('name' => $array['username'], "body" => "Your product was approved by system administrator. Please check the product: http://rfq.projexonlineservices.com/myproduct");
                    $array['subject'] = "Successfully approved product.";
                    $array['sender_address'] = "jovanovic.nemanja.1029@gmail.com";

                    $controller->save($array);
                }else{
                    $record[0]->status = 1;
                    $record[0]->update();

                    $data = [];
                    $data['title'] = 'Pending';
                    $data['description'] = 'Product Name: '.$record[0]->name;
                    $add_logs = Adminlogs::Addlog($data);
                }
            }else{
                return back();
            }
            return redirect()->route('products.index')->with('flash', 'Product has been successfully changed the status');
        }else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $res = Product::where('id', $id)->first();
            $record = Product::where('id', $id)->delete();

            $data = [];
            $data['title'] = 'Deleted';
            $data['description'] = 'Product Name: '.$res['name'];
            $add_logs = Adminlogs::Addlog($data);

            return redirect()->route('products.index')->with('flash', 'Product has successfully deleted');
        }else{
            return back();
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('flash', 'Product has successfully deleted');
    }
}
