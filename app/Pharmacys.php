<?php

namespace App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Pharmacys extends Model
{
    public $table = "pharmacys";

    public $fillable = ['user_id', 'pharmacy_firstname', 'pharmacy_lastname', 'pharmacy_street1', 'pharmacy_street2', 'pharmacy_city', 'pharmacy_phone', 'pharmacy_fax', 'sign_date'];
}
