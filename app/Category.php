<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    ///////////////////////////// sub category part ///////////////////////////////////

    // public $fillable = ['name', 'parent', 'slug', 'sign_date'];
    
    ///////////////////////////// sub category part ///////////////////////////////////
    
    public $fillable = ['name', 'slug', 'sign_date'];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function scopeSearchId($query, $param) {
    	$category = $query->where('slug', $param)
    					  ->orWhere('name', 'like', '%'.$param.'%')
    					  ->first();

    	return $category ? $category->id : false;
    }
}
