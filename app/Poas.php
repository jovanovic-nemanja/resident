<?php

namespace App;

use App\Poas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Poas extends Model
{
    public $table = "poas";

    public $fillable = ['user_id', 'poa_type', 'poa_firstname', 'poa_lastname', 'poa_street1', 'poa_street2', 'poa_city', 'poa_zip_code', 'poa_state', 'poa_home_phone', 'poa_cell_phone', 'sign_date'];
}
