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

    public $fillable = ['type', 'description', 'resident_id', 'clinic_id', 'user_id', 'sign_date'];

    /**
    * @param array data 
    * @return boolean true or false
    * @since 2021-05-12
    * @author Nemanja
    */
    public static function AddactivityLogs($data)
    {
    	if (@$data) {
    		$dates = User::getformattime();
	        $date = $dates['date'];

    		$res = Reports::create([
                'type' => $data['type'],    //1: primary activity, 2: secondary activity
                'description' => $data['activityDuration'] . " ( " . $data['activityTime'] . " ) : " . $data['activityName'],
	            'resident_id' => $data['resident_id'],
                'clinic_id' => $data['clinic_id'],
                'user_id' => $data['user_id'],
	            'sign_date' => $date,
	        ]);

	        return true;
    	}

    	return false;
    }

    /**
    * @param array data 
    * @return boolean true or false
    * @since 2021-05-16
    * @author Nemanja
    */
    public static function AddmedicationLogs($data)
    {
    	if (@$data) {
    		$dates = User::getformattime();
	        $date = $dates['date'];

    		$res = Reports::create([
                'type' => $data['type'],  //1: primary activity, 2: secondary activity, 3: medication Routine, 4: PRN
                'description' => $data['medicationTime'] . " : " . $data['medicationName'],
	            'resident_id' => $data['resident_id'],
                'clinic_id' => $data['clinic_id'],
                'user_id' => $data['user_id'],
	            'sign_date' => $date,
	        ]);

	        return true;
    	}

    	return false;
    }

    /**
    * @param $type 
    * @return type as string
    * @since 2021-05-16
    * @author Nemanja
    */
    public static function getTypeById($type)
    {
    	switch ($type) {
            case '1':   //Primary Activity
                $duration = "Primary Activity";
                break;
            case '2':   //Secondary Activity
                $duration = "Secondary Activity";
                break;
            case '3':   //Medication Routine
                $duration = "Medication Routine";
                break;    
            case '4':   //Medication PRN
                $duration = "Medication PRN";
                break;    

            default:
                $duration = "Primary Activity";
                break;
        }

    	return $duration;
    }
}
