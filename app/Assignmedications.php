<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Medications;
use App\Assignmedications;

class Assignmedications extends Model
{
    public $table = "assign_medications";

    public $fillable = ['medications', 'dose', 'duration', 'resident', 'comment', 'sign_date'];

    public function getMedications($id) 
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
}
