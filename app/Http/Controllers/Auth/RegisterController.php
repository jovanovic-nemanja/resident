<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Session;
use App\User;
use App\Role;
use App\RoleUser;
use App\Facilities;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'profile_logo' => 'required',
            'clinic_name' => 'required|string|max:190',
            'firstname' => 'required|string|max:190',
            'lastname' => 'required|string|max:190',
            'username' => 'required|string|max:190|unique:users',
            'email' => 'required|string|email|max:190',
            'password' => 'string|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'username' => $data['username'],
                'email' => $data['email'],
                'gender' => 1,
                'password' => Hash::make($data['password']),
                'phone_number' => @$data['phone_number'],
                'sign_date' => date('Y-m-d h:i:s'),
            ]);

            if(@$data['profile_logo']) {
                User::upload_logo_img($user->id);    
            }            

            RoleUser::create([
                'user_id' => $user->id,
                'role_id' => 4,
            ]);

            $facility = Facilities::create([
                'clinic_name' => $data['clinic_name'],
                'clinic_id' => $user->id,
                'sign_date' => date('Y-m-d h:i:s')
            ]);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }            
    }

    public function registerasclinic() 
    {
        return view('auth.clinic');
    }

    public function emailverify() 
    {
        Session::put('role', 'buyer');
        $role = "buyer";
        $email = '';
        return view('auth.emailverify', compact('role', 'email'));
    }

    public function emailverifyseller() 
    {
        Session::put('role', 'seller');
        $role = "seller";
        $email = '';
        return view('auth.emailverify', compact('role', 'email'));
    }

    public function emailverifyforresend($email, $role) 
    {
        $role = $role;

        return view('auth.emailverify', compact('role', 'email'));
    }
}
