<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Medications;
use App\Usermedications;


class Usermedications extends Model
{
    public $table = "user_medications";

    public $fillable = ['medications', 'daily_count', 'duration', 'resident', 'comment', 'file', 'status', 'sign_date'];

    /**
    * @param user_id
    * This is a feature to upload a company logo
    */
    public static function upload_file($id, $existings = null) {
        if(!request()->hasFile('file')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('file'));

        self::save_file($id, request()->file('file'));
    }

    public static function save_file($id, $file) {
        $medications = Usermedications::where('id', $id)->first();

        if($medications) {
            Storage::disk('public_local')->delete('uploads/', $medications->file);
            $medications->file = $file->hashName();
            $medications->update();
        }
    }

    public static function getStatus($status)
    {
        $str = '';

        switch ($status) {
            case '1':
                $str = "Assigning";
                break;
            case '2':
                $str = "Assigned";
                break;
            default:
                $str = "Assigning";
                break;
        }

        return $str;
    }

    public function getMedications($id) 
    {
    	if (@$id) {
    		$user_medications = Usermedications::where('id', $id)->first();
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
    		$user_medications = Usermedications::where('id', $id)->first();
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
}
