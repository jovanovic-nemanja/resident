<?php

namespace App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    public $table = "reports";

    public $fillable = ['content', 'sign_date'];

    /**
    * @param time
    * @return time
    * @since 2021-05-12
    * @author Nemanja
    */
    public static function Addlogs($data)
    {
    	if (@$data) {
    		$dates = User::getformattime();
	        $date = $dates['date'];
	        $time = $dates['time'];

    		$res = Reports::create([
	            'content' => $data,
	            'sign_date' => $date,
	        ]);

	        return true;
    	}

    	return false;
    }
}
