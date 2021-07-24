<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    public $table = "facilities";

    public $fillable = ['clinic_name', 'clinic_id', 'sign_date'];
}
