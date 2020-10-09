<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    public $table = "activities";

    public $fillable = ['title', 'type', 'content', 'sign_date'];
}
