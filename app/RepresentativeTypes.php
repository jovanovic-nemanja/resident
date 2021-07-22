<?php

namespace App;

use App\RepresentativeTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class RepresentativeTypes extends Model
{
    public $table = "representative_types";

    public $fillable = ['title', 'clinic_id', 'sign_date'];
}
