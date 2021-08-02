<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    public $table = "templates";

    public $fillable = ['name', 'id', 'sign_date'];
}
