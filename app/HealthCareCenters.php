<?php

namespace App;

use App\HealthCareCenters;
use App\HealthCareCenterTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HealthCareCenters extends Model
{
    public $table = "health_care_centers";

    public $fillable = ['user_id', 'health_care_center_type', 'firstname', 'lastname', 'street1', 'street2', 'city', 'phone', 'fax', 'sign_date'];

    public static function getTypeasstring($id)
    {
        if (@$id) {
            $type = HealthCareCenterTypes::where('id', $id)->first();
            if (@$type) {
                $title = $type->title;
            }else{
                $title = "None";
            }
        }else{
            $title = "None";
        }

        return $title;
    }
}
