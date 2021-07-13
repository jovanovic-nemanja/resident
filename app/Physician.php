<?php

namespace App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Physician extends Model
{
    public $table = "physician_medicals";

    public $fillable = ['user_id', 'physician_or_medical_group_firstname', 'physician_or_medical_group_lastname', 'physician_or_medical_group_street1', 'physician_or_medical_group_street2', 'physician_or_medical_group_city', 'physician_or_medical_group_phone', 'physician_or_medical_group_fax', 'sign_date'];
}
