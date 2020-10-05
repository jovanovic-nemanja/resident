<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $fillable = ['name', 'sign_date'];

    public $table = 'unit';
}
