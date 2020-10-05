<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\User;
use App\Requests;
use App\Adminlogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;

class RequestsController extends Controller
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
        $categories = Requests::all();
        return view('admin.requests.index', compact('categories'));
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
        if (@Request('sellers')) {
            $arrs = Request('sellers');
            $values;

            foreach ($arrs as $key => $value) {
                if ($key == 0) {
                    $values = $value;
                }else{
                    $values .= ','.$value;
                }

                $userid = $value;
                $user = User::where('id', $userid)->first();
                $username = $user->name;
                $useremail = $user->email;

                $controller = new EmailsController;
                $array = [];
                $array['username'] = $username;
                $array['receiver_address'] = $useremail;
                $array['data'] = array('name' => $array['username'], "body" => "Please check this URL: http://rfq.projexonlineservices.com/request");
                $array['subject'] = "The following RFQ has been assigned to you by administrator.";
                $array['sender_address'] = "jovanovic.nemanja.1029@gmail.com";

                $controller->save($array);
            }
            $id = Request('id');
            $records = Requests::where('id', $id)->first();

            $data = [];
            $data['title'] = 'Assigned';
            $data['description'] = 'RFQ Name: '.$records->product_name;
            $add_logs = Adminlogs::Addlog($data);

            $records->receiver = '['.$values.']';
            $records->update();
        }

        return redirect()->route('requests.index')->with('flash', 'Sellers has been successfully choosed.');
    }

    public function assign($id)
    {
        if (@$id) {
            $records = Requests::where('id', $id)->first();
        }else{
            $records = '';
        }

        $sellers = DB::table('users')
                            ->Join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', 2)
                            ->where('users.block', 0)
                            ->select('users.*')
                            ->get();

        return view('admin.requests.assign', compact('records', 'sellers'));
    }

    public function view($id)
    {
        if (@$id) {
            $records = Requests::where('id', $id)->first();
        }else{
            $records = '';
        }

        return view('admin.requests.view', compact('records'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $record = Requests::where('id', $id)->get();
            if (@$record) {
                if ($record[0]->status == NULL || $record[0]->status == 1) {
                    $record[0]->status = 2;
                    $record[0]->update();

                    $data = [];
                    $data['title'] = 'Approved';
                    $data['description'] = 'RFQ Name: '.$record[0]->product_name;
                    $add_logs = Adminlogs::Addlog($data);

                    $userid = $record[0]->sender;
                    $user = User::where('id', $userid)->first();
                    $username = $user->name;
                    $useremail = $user->email;

                    $controller = new EmailsController;
                    $array = [];
                    $array['username'] = $username;
                    $array['receiver_address'] = $useremail;
                    $array['data'] = array('name' => $array['username'], "body" => "You will recieve quotes from suppliers shortly.");
                    $array['subject'] = "Congratulation your rfq has been approved.";
                    $array['sender_address'] = "jovanovic.nemanja.1029@gmail.com";

                    $controller->save($array);

                    $arrs = $record[0]->receiver;
                    if (@$arrs) {
                        $diff = str_replace('[', '', $arrs);
                        $diff1 = str_replace(']', '', $diff);
                        $arr = [];
                        $diff_arrays = explode(',', $diff1);

                        foreach ($diff_arrays as $key => $value) {
                            $userid = $value;
                            $user = User::where('id', $userid)->first();
                            $username = $user->name;
                            $useremail = $user->email;

                            $controller = new EmailsController;
                            $array = [];
                            $array['username'] = $username;
                            $array['receiver_address'] = $useremail;
                            $array['data'] = array('name' => $array['username'], "body" => "Please check this URL: http://rfq.projexonlineservices.com/request");
                            $array['subject'] = "The following RFQ has been assigned to you by administrator.";
                            $array['sender_address'] = "jovanovic.nemanja.1029@gmail.com";

                            $controller->save($array);
                        }
                    }
                }else{
                    $record[0]->status = 1;
                    $record[0]->update();

                    $data = [];
                    $data['title'] = 'Pending';
                    $data['description'] = 'RFQ Name: '.$record[0]->product_name;
                    $add_logs = Adminlogs::Addlog($data);
                }
            }else{
                return back();
            }
            return redirect()->route('requests.index')->with('flash', 'Request status has been successfully changed.');
        }else{
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $record = Requests::where('id', $id)->delete();
            return redirect()->route('requests.index')->with('flash', 'Request has successfully deleted');
        }else{
            return back();
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $requests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        //
    }
}
