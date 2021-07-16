<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Switchreminder extends Model
{
    public $table = "switch_reminder";

    public $fillable = ['status', 'clinic_id', 'set_time'];
}
