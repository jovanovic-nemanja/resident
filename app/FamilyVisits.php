<?php

namespace App;

use App\Relations;
use App\FamilyVisits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class FamilyVisits extends Model
{
    public $table = "family_visits";

    public $fillable = ['resident', 'relation', 'comment', 'sign_date'];

    public static function getRelationasStr($relation)
    {
        if (@$relation) {
            $relation = Relations::where('id', $relation)->first();
            $str = $relation->title;
        }else{
            $str = "None";
        }

        return $str;
    }
}
