<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievedquotes extends Model
{
    public $fillable = ['request_id', 'sign_date'];

    public $table = "achieved_quotes";
}
