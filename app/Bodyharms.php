<?php

namespace App;

use App\User;
use App\Bodyharms;
use App\Bodyharmcomments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Bodyharms extends Model
{
    public $table = "body_harms";

    public $fillable = ['resident', 'comment', 'sign_date', 'screenshot_3d'];

    /**
    * @param user_id
    * This is a feature to upload a screen shot image
    */
    public static function upload_file($id, $existings = null) {
        if(!request()->hasFile('screenshot_3d')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('screenshot_3d'));

        self::save_file($id, request()->file('screenshot_3d'));
    }

    public static function save_file($id, $file) {
        $bodyharm = Bodyharms::where('id', $id)->first();

        if($bodyharm) {
            Storage::disk('public_local')->delete('uploads/', $bodyharm->screenshot_3d);
            $bodyharm->screenshot_3d = $file->hashName();
            $bodyharm->update();
        }
    }

    public static function getCommentbystring($comment_id)
    {
    	if (@$comment_id) {
    		$res = Bodyharmcomments::where('id', $comment_id)->first();
    	}else{
    		$res = [];
    	}

    	return $res->name;
    }
}
