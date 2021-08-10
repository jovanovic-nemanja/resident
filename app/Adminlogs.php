<?php

namespace App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Adminlogs extends Model
{
    public $table = "admin_logs";

    public $fillable = ['content', 'clinic_id', 'caretakerId', 'sign_date'];

    /**
    * @param time
    * @return time
    * @since 2020-10-16
    * @author Nemanja
    */
    public static function Addlogs($data)
    {
    	if (@$data) {
    		$dates = User::getformattime();
            if(auth()->user()->hasRole('clinicowner')) {
                $clinic_id = auth()->id();
            }else{
                $user_rec = User::where('id', auth()->id())->first();
                $clinic_id = $user_rec->clinic_id;
            }

	        $date = $dates['date'];
	        $time = $dates['time'];

    		$res = Adminlogs::create([
	            'caretakerId' => $data['caretakerId'],
	            'content' => $data['content'],
                'clinic_id' => $clinic_id,
	            'sign_date' => $date,
	        ]);

	        return true;
    	}

    	return false;
    }
}
