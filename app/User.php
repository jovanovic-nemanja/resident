<?php

namespace App;

use App\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        'name', 'username', 'email', 'birthday', 'address', 'password', 'phone_number', 'sign_date', 'gender', 'email_verified_at', 'profile_logo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    public function getUsername($id) {
        if (@$id) {
            $user = User::where('id', $id)->first();
            $name = $user->name;
        }

        return $name;
    }

    /**
    * @param user_id
    * This is a feature to upload a company logo
    */
    public static function upload_logo_img($user_id, $existings = null) {
        if(!request()->hasFile('profile_logo')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('profile_logo'));

        self::save_logo_img($user_id, request()->file('profile_logo'));
    }

    public static function save_logo_img($user_id, $image) {
        $user = User::where('id', $user_id)->first();

        if($user) {
            Storage::disk('public_local')->delete('uploads/', $user->profile_logo);
            $user->profile_logo = $image->hashName();
            $user->update();
        }
    }

    public static function getformattime()
    {
        $timeZone = 'America/Los_Angeles';
        date_default_timezone_set($timeZone);
        $date = date('Y-m-d H:i:s');
        $time = date('H:i:s');
        $arr = [];
        $arr['date'] = $date;
        $arr['time'] = $time;

        return $arr;
    }
}
