<?php

namespace App;

use App\User;
use App\Reviews;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    public $fillable = ['putter', 'receiver', 'mark', 'description', 'sign_date', 'purchase_id'];

    public $table = "reviews";


    public function getUsername($id) {
        if(@$id) {
            $results = User::where('id', $id)->get();
            if(@$results) {
                $result = $results[0]->name;
            }else{
                $result = "None";    
            }
        }else {
            $result = "None";
        }

        return $result;
    }

    public function Isreview($id) {
        $userid = auth()->id();
        
        if (@$id) {
            $result = Reviews::where('purchase_id', $id)->where('putter', $userid)->first();
            if (@$result) {
                return true;
            }else{
                return false;
            }
        }
        
        return false;
    }
}
