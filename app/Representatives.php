<?php

namespace App;

use App\Representatives;
use App\RepresentativeTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Representatives extends Model
{
    public $table = "representatives";

    public $fillable = ['user_id', 'representative_type', 'firstname', 'lastname', 'street1', 'street2', 'city', 'zip_code', 'state', 'home_phone', 'cell_phone', 'sign_date'];

    public static function getTypeasstring($id)
    {
        if (@$id) {
            $type = RepresentativeTypes::where('id', $id)->first();
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
