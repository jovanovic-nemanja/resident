<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Comments;
use App\Activities;
use App\Useractivities;

class Useractivities extends Model
{
    public $table = "user_activities";

    public $fillable = ['activities', 'time', 'resident', 'comment', 'file', 'status', 'sign_date'];

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
        $activities = Useractivities::where('id', $id)->first();

        if($activities) {
            Storage::disk('public_local')->delete('uploads/', $activities->file);
            $activities->file = $file->hashName();
            $activities->update();
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

    public static function getCommentById($comment_id)
    {
        if (@$comment_id) {
            $result = Comments::where('id', $comment_id)->first();
        }
        else{
            $result = '';
        }

        return $result->name;
    }
}
