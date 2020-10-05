<?php

namespace App;

use App\User;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

	public $fillable = ['name', 'MOQ', 'description', 'user_id', 'price_from', 'price_to', 'category_id', 'image_url', 'slug', 'sign_date', 'username', 'status'];

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'slug';
	}

    public function path() {
        return "/product/{$this->slug}";
    }

    public function images() {
    	return $this->hasMany('App\Image');
    }

    public function getUsername($userid) {
        $record = User::where('id', $userid)->get();
        if(@$record) {
            $result = $record[0]->name;
        }else{
            $result = "None";
        }

        return $result;
    }

    public function getcompanyName($userid) {
        $record = User::where('id', $userid)->get();
        if(@$record) {
            $result = $record[0]->company_name;
        }else{
            $result = "None";
        }

        return $result;
    }

    public function getcompanyLogo($userid) {
        $record = User::where('id', $userid)->get();
        if(@$record) {
            $result = $record[0]->company_logo;
        }else{
            $result = "None";
        }

        return $result;
    }

    public function getCategoryname($cateid) {
        $record = Category::where('id', $cateid)->get();
        if(@$record) {
            $result = $record[0]->name;
        }else{
            $result = "None";
        }
        
        return $result;
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function thumbnailUrl() {
        $first_image = $this->images->first();
        return $first_image ? $first_image->url : '';
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getstatuesname($id) {
        if(@$id) {
            if ($id == 1) {
                $name = "Pending";
            }else if ($id == 2) {
                $name = "Approved";
            }else{
                $name = "Canceled";
            }
        }else {
            $name = "Pending";
        }

        return $name;
    }

    public function vendor() {
        // $shop_name = $this->user->shop->name;
        // $vendor    = $shop_name ? $shop_name : $this->user->name;

        // return $vendor;
    }

    public function vendor_url() {
        $shop_id = $this->user->shop->id;
        $url     = $shop_id ? route('shop.show', $shop_id) : null;

        return $url;
    }

    public function scopeFilter($query, $filters) {
        return $filters->apply($query);
    }

    public function scopeGetUserId($query, $product_id)
    {
        return $query->select('user_id')
                     ->where('id', $product_id)
                     ->first()
                     ->user_id;
    }
}
