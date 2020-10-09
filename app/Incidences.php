<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Incidences extends Model
{
    public $table = "incidences";

    public $fillable = ['title', 'type', 'content', 'sign_date'];
}
