<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Auth;
use Session;
 
class SessionExpired {
    protected $session;
    protected $timeout = 36000;
     
    public function __construct(Store $session){
        $this->session = $session;
    }

    public function handle($request, Closure $next){
        $isLoggedIn = $request->path() != 'dashboard/logout';
        if(! session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            $this->session->forget('lastActivityTime');
            $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'home');
            auth()->logout();
            return redirect()->route('login');
        }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);    
    }
}