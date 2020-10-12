<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Activities;
use App\Useractivities;

class Useractivities extends Model
{
    public $table = "user_activities";

    public $fillable = ['activities', 'time', 'resident', 'comment', 'status', 'sign_date'];

    public function getActivities($id) 
    {
    	if (@$id) {
    		$user_activities = Useractivities::where('id', $id)->first();
    		if (@$user_activities) {
    			$user_activities_id = $user_activities->activities;
    			$activities = Activities::where('id', $user_activities_id)->first();
    		}else{
    			$activities = "";	
    		}
    	}else{
    		$activities = "";
    	}

    	return $activities;
    }

    public function getResident($id) 
    {
    	if (@$id) {
    		$user_activities = Useractivities::where('id', $id)->first();
    		if (@$user_activities) {
    			$user_resident_id = $user_activities->resident;
    			$user = User::where('id', $user_resident_id)->first();
    		}else{
    			$user = "";	
    		}
    	}else{
    		$user = "";
    	}

    	return $user;
    }

    public function getTypeasstring($id) 
    {
    	if (@$id) {
    		if ($id == 1) {
    			$result = "Primary ADL";
    		}if ($id == 2) {
    			$result = "Secondary ADL";
    		}
    	}else{
    		$result = "None";
    	}

    	return $result;
    }
}
