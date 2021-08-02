<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    public $table = "routes";

    public $fillable = ['name', 'clinic_id', 'template_id', 'sign_date'];

    public static function getRoutename($id)
    {
    	if (@$id) {
    		$result = Routes::where('id', $id)->first();
    	}

    	return $result['name'];
    }
}
