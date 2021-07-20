<?php

namespace App;

use App\Relations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Relations extends Model
{
    public $table = "relations";

    public $fillable = ['clinic_id', 'title', 'sign_date'];
}
