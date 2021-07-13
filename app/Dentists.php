<?php

namespace App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Dentists extends Model
{
    public $table = "dentists";

    public $fillable = ['user_id', 'dentist_firstname', 'dentist_lastname', 'dentist_street1', 'dentist_street2', 'dentist_city', 'dentist_phone', 'dentist_fax', 'sign_date'];
}
