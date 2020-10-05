<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use App\User;
use App\Emails;
use App\VerifyEmailcodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmailsController extends Controller
{
    public function __construct(){

        // $this->middleware('auth');

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
        
    }

    public function save($request)
    {
        DB::beginTransaction();

        $data = $request['data'];
        $description = $data['body'];
        $username = $request['username'];
        $useremail = $request['receiver_address'];
        $subject = $request['subject'];

        try {
            Mail::send('frontend.mail.mail', $data, function($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('solaris.dubai@gmail.com', 'Administrator');
            });

            $email = Emails::create([
                'sender_address'        => $request['sender_address'],
                'receiver_address' => $request['receiver_address'],
                'header'       => $subject,
                'title' => "Hi, ".$username,
                'description'        => $description,
                'sign_date'     => date('y-m-d h:i:s'),
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }   
    }

    public function sendverifycode(Request $request)
    {
        $this->validate(request(), [
            'email'        => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::beginTransaction();

        $str = rand(100000, 999999);
        $url = "https://rfq.mambodubai.com/emails/directconfirmpage/".$request['email']."/".$request['role']."/".$str;
        $data = [];
        $data['name'] = 'User';
        $data['body'] = 'Thank you for registering with us. <br> To complete your registration, please verify your email by clicking on this <a href="'.$url.'">link</a> and entering the following code '.$str.'.<br><br><br><a href="'.$url.'" style="padding: 10px 30px; text-decoration: none; font-size: 24px; border-radius: 0; background-color: #476B91; color: #ffffff;">Verify</a>';

        $useremail = $request['email'];
        $role = $request['role'];
        $username = 'Mambo Dubai';
        $subject = "Verify your email for Mambo Dubai";


        try {
            Mail::send('frontend.mail.mail', $data, function($message) use ($username, $useremail, $subject) {
                $message->to($useremail, $username)->subject($subject);
                $message->from('solaris.dubai@gmail.com', 'Administrator');
            });

            $verify = VerifyEmailcodes::where('email', $useremail)->first();
            if (@$verify) {
                $verify->verify_code = $str;
                $verify->password = $request['password'];
                $verify->update();
            }else{
                $VerifyEmailcodes = VerifyEmailcodes::create([
                    'email' => $useremail,
                    'verify_code' => $str,
                    'password' => $request['password'],
                ]);
            }

            $id = '';
            $msg = '';

            DB::commit();
            return view('auth.confirmverifycode', compact('useremail', 'role', 'id', 'msg'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }   
    }

    public function directconfirmpage($email, $role, $id, $msg = null)
    {
        if (@$id && @$role && @$email) {
            $useremail = $email;

            return view('auth.confirmverifycode', compact('useremail', 'role', 'id', 'msg'));
        }
    }

    public function validatecode(Request $request)
    {
        $useremail = $request['email'];
        $role = $request['role'];
        $verify_codes = $request['verify_codes'];
        // echo "mail = ".$useremail;
        // echo "<br>";
        // echo "codes = ".$verify_codes;
        // echo "<br>";
        $validate = VerifyEmailcodes::where('email', $useremail)->first();
        // echo "codes = ".$validate->verify_code;
        if (@$validate) {
            if ($validate->verify_code == $verify_codes) {
                if ($role == 'buyer') {
                    return view('auth/register', compact('useremail'));
                }
                if ($role == 'seller') {
                    return view('auth/sellerregister', compact('useremail'));
                }
            }else{
                $msg = "Verify codes is failed. ";
                $id = '';
                return view('auth.confirmverifycode', compact('useremail', 'role', 'id', 'msg'));
            }
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
        //
    }
}
