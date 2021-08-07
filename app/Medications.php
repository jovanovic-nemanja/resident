<?php

namespace App;

use App\Medications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    public $table = "medications";

    public $fillable = ['name', 'brand_name', 'comments', 'clinic_id', 'template_id', 'sign_date'];
}
