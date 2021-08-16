<?php

namespace App;

use App\Moods;
use App\MoodChanges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MoodChanges extends Model
{
    public $table = "mood_changes";

    public $fillable = ['resident', 'mood', 'description', 'sign_date'];

    public static function getMoodasStr($mood)
    {
        if (@$mood) {
            $mood = Moods::where('id', $mood)->first();
            $str = ($mood->title) ? $mood->title : 'None';
        }else{
            $str = "None";
        }

        return $str;
    }
}
