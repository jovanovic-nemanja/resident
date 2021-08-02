<?php

namespace App;

use App\HealthCareCenterTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HealthCareCenterTypes extends Model
{
    public $table = "health_care_center_types";

    public $fillable = ['title', 'clinic_id', 'template_id', 'sign_date'];
}
