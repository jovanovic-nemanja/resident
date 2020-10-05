<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\RoleUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
      * Redirect the user to the Google authentication page.
      *
      * @return \Illuminate\Http\Response
      */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
      * Redirect the user to the Google authentication page.
      *
      * @return \Illuminate\Http\Response
      */
    public function redirectToProvidergoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return redirect('auth/github');
        }

        // check if they're an existing user
        $existingUser = User::where('github_id', $user->id)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $role = Session::get('role');
            if (@$role) {
                $newUser                  = new User;
                $newUser->name            = $user->name;
                $newUser->email           = $user->email;
                $newUser->sign_date           = date('Y-m-d');
                $newUser->github_id       = $user->id;
                $newUser->save();

                if ($role == "buyer") { //Buyer case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 3,
                    ]);
                }if ($role == "seller") { //Seller case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 2,
                    ]);
                }

                auth()->login($newUser, true);
            }else{
                $msg = "We have not this github account!";
                return view('auth/login', compact('msg'));
            }
        }

        return redirect()->to('/');
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackgoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $role = Session::get('role');
            if (@$role) {
                $newUser                  = new User;
                $newUser->name            = $user->name;
                $newUser->email           = $user->email;
                $newUser->sign_date           = date('Y-m-d');
                $newUser->google_id       = $user->id;
                $newUser->save();

                if ($role == "buyer") { //Buyer case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 3,
                    ]);
                }if ($role == "seller") { //Seller case
                    RoleUser::create([
                        'user_id' => $newUser->id,
                        'role_id' => 2,
                    ]);
                }

                auth()->login($newUser, true);
            }else{
                $msg = "We have not this google account!";
                return view('auth/login', compact('msg'));
            }
        }
        return redirect()->to('/');
    }

    public function redirectTo(){
        // User role
        if(auth()->user()->hasRole('seller')) {
            return '/sellerdashboard';
        }
        if (auth()->user()->hasRole('buyer')) {
            return '/buyerdashboard';
        }
        if (auth()->user()->hasRole('admin')) {
            return '/admin';
        }
        if (auth()->user()->hasRole('manager')) {
            return '/manager';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('guest')->except('logout');
    }
}
