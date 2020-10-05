<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Purchaseorders extends Model
{
    public $fillable = ['request_id', 'payment_status', 'payment_information', 'sign_date'];

    public $table = "purchase_orders";

    public function getstatus($id)
    {
    	$status = "Payment Pending";

    	switch ($id) {
    		case '1':
    			$status = "Payment Pending";
    			break;
    		case '2':
    			$status = "Payment Received";
    			break;
    		case '3':
    			$status = "Delivery Fine";
    			break;
    		default:
    			break;
    	}

    	return $status;
    }

    public function getUsername($id) {
        if (@$id) {
            $record = User::where('id', $id)->first();
            return $record->name;
        }else{
            return "None";
        }
    }
}
