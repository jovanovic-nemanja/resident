<?php

namespace App;

use App\Moods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Moods extends Model
{
    public $table = "moods";

    public $fillable = ['clinic_id', 'title', 'sign_date'];
}
