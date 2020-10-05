<?php

namespace App;

use App\Reviews;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company_name', 'company_logo', 'email', 'github_id', 'google_id', 'password', 'phone_number', 'sign_date', 'block', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shop() {
        return $this->hasOne('App\Shop')->withDefault();
    }

    public function addresses() {
        return $this->hasMany('App\Address');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function roles() {
    	return $this->belongsToMany('App\Role');
    }

    public function hasRole($role_name) {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $role_name)
            {
                return true;
            }
        }

        return false;
    }

    public function getBlockstatus($id) {
        if (@$id) {
            if ($id == 0) { //normal status
                $result = "Normal";
            }else if ($id == 1) {   //user blocked status
                $result = "Blocked";
            }
        }else{
            $result = "Normal";
        }

        return $result;
    }

    public static function getMarks($id) {
        if (@$id) {
            $marks = DB::table('reviews')
                        ->where('receiver', $id)
                        ->avg('mark');

            return $marks;
        }
    }

    public function getUsername($id) {
        if (@$id) {
            $user = User::where('id', $id)->first();
            $name = $user->name;
        }

        return $name;
    }
}
