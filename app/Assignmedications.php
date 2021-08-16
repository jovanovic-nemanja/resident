<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Units;
use App\Medications;
use App\Assignmedications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Assignmedications extends Model
{
    public $table = "assign_medications";

    public $fillable = ['medications', 'dose', 'photo', 'units', 'resident', 'route', 'sign_date', 'time', 'start_day', 'end_day'];

    public static function getMedications($id) 
    {
    	if (@$id) {
    		$user_medications = Assignmedications::where('id', $id)->first();
    		if (@$user_medications) {
    			$user_medications_id = $user_medications->medications;
    			$medications = Medications::where('id', $user_medications_id)->first();
    		}else{
    			$medications = "";	
    		}
    	}else{
    		$medications = "";
    	}

    	return $medications;
    }

    public function getResident($id) 
    {
    	if (@$id) {
    		$user_medications = Assignmedications::where('id', $id)->first();
    		if (@$user_medications) {
    			$user_resident_id = $user_medications->resident;
    			$user = User::where('id', $user_resident_id)->first();
    		}else{
    			$user = "";	
    		}
    	}else{
    		$user = "";
    	}

    	return $user;
    }

    public static function getRemainingDays($start)
    {
        if (@$start) {
            $current = User::getformattime();
            $cur_date = $current['dates'];

            $startTimeStamp = strtotime($start);
            $endTimeStamp = strtotime($cur_date);

            $timeDiff = abs($endTimeStamp - $startTimeStamp);

            $numberDays = $timeDiff/86400;  // 86400 seconds in one day

            // and you might want to convert to integer
            $numberDays = intval($numberDays);
            return $numberDays;
        }
    }

    /**
    * @param user_id
    * This is a feature to upload a company logo
    */
    public static function upload_file($id, $existings = null) {
        if(!request()->hasFile('photo')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('photo'));

        self::save_file($id, request()->file('photo'));
    }

    public static function save_file($id, $file) {
        $medication = Assignmedications::where('id', $id)->first();

        if($medication) {
            Storage::disk('public_local')->delete('uploads/', $medication->photo);
            $medication->photo = $file->hashName();
            $medication->update();
        }
    }

    public static function getTitle($id)
    {
        if (@$id) {
            $result = Units::where('id', $id)->first();
            if (@$result) {
                $res = $result->title;
            }else{
                $res = 'None';
            }
        }else{
            $res = 'None';
        }

        return $res;
    }
}
