<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ResidentSettings extends Model
{
    public $table = "resident_settings";

    public $fillable = ['user_id', 'fieldVal', 'sign_date'];
}
