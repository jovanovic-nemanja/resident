<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $fillable = ['purchase_id', 'description', 'writer', 'sign_date'];

    public $table = "comments";

    public function getUsername($userid)
    {
    	if (@$userid) {
    		$user = User::where('id', $userid)->first();

    		return $user->name;
    	}
    }
}
