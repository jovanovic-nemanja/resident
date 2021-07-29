<?php

namespace App\Http\Controllers\Frontend;

use App\Tabs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('clinicowner')) {

            $clinic_id = auth()->id();
            $user = User::where('id', $clinic_id)->first();
            if($user->status != 1) {
                Auth::logout();

                return redirect()->route('login')->with('danger', 'Your account is not actived yet. Please ask to support team.');
            }else{

                $setting_tabs = Tabs::all();
                $residents = DB::table('users')
                                ->select('users.*')
                                ->Join('role_user', 'role_user.user_id', '=', 'users.id')
                                ->where('role_user.role_id', 3)
                                ->where('users.clinic_id', $clinic_id)
                                ->get();

                return view('frontend.home', compact('residents', 'setting_tabs'));

            }

        }else if(auth()->user()->hasRole('care taker')) {

            $userid = auth()->id();
            $user = User::where('id', $userid)->first();
            $clinic_id = $user->clinic_id;
            $setting_tabs = Tabs::all();

            $residents = DB::table('users')
                            ->select('users.*')
                            ->Join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', 3)
                            ->where('users.clinic_id', $clinic_id)
                            ->get();

            return view('frontend.home', compact('residents', 'setting_tabs'));

        }else if(auth()->user()->hasRole('admin')) {

            $clinicowners = DB::table('users')
                            ->select('users.*', 'facilities.clinic_name')
                            ->Join('role_user', 'role_user.user_id', '=', 'users.id')
                            ->Join('facilities', 'facilities.clinic_id', '=', 'users.id')
                            ->where('role_user.role_id', 4)
                            ->get();

            return view('frontend.admin', compact('clinicowners'));

        }
    }

    /**
     * change the clinic owner status as active or deactive
     *
     * @since 2021-07-16
     * @author Nemanja
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clinicstatus(Request $request)
    {
        $this->validate(request(), [
            'clinic_id' => 'required'
        ]);

        $record = User::where('id', $request->clinic_id)->first();
        if (@$record) {
            $record->status = ($record->status) ? NULL : 1;

            $record->update();
        }

        return redirect()->route('home');
    }

    /**
     * Display a Change password page.
     *
     * @return \Illuminate\Http\Response
     */
    public function changepass()
    {
        $user = auth()->user();
        return view('frontend.changepass', compact('user'));
    }

    /**
     * Change password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword()
    {
        $user = auth()->user();

        if ($user->password) {
            $this->validate(request(), [
                'old_password' => 'required',
                // 'password' => 'required',
                // 'password_confirmation' => 'required|same:password',
                'password_confirmation' => 'same:password'
            ]);

            if (Hash::check(request('old_password'), $user->password)) {
                $user->password = Hash::make(request('password'));
                $user->save();
                return redirect()->route('home')->with('flash', 'Password has been successfully changed.');
            }else{
                $this->validate(request(), [
                    'old_password' => 'confirmed',
                ]);
            }
        }else{
            $this->validate(request(), [
                // 'old_password' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);

            $user->password = Hash::make(request('password'));
            $user->save();
            return redirect()->route('changepass')->with('flash', 'Password has been successfully changed.');
        }
    }
}
