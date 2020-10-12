<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    public $table = "activities";

    public $fillable = ['title', 'type', 'sign_date'];

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
