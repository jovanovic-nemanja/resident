<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Adminlogs extends Model
{
    public $fillable = ['admin_id', 'description', 'title', 'sign_date'];

    public $table = "adminlogs";

    public function getAdminname($id) {
    	if (@$id) {
    		$admin = User::where('id', $id)->first();
    		$admin_name = $admin->name;
    	}else{
    		$admin_name = '';
    	}

    	return $admin_name;
    }

    public static function Addlog($data) {
    	if (@$data) {
    		$res = Adminlogs::create([
	            'admin_id' => auth()->id(),
	            'title' => $data['title'],
	            'description' => $data['description'],
	            'sign_date' => date('Y-m-d H:i:s'),
	        ]);
    	}
    }
}
