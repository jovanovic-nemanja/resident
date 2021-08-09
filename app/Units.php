<?php

namespace App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    public $table = "units";

    public $fillable = ['title', 'clinic_id', 'template_id', 'sign_date'];
}
