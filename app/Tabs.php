<?php

namespace App;

use App\User;
use App\Tabs;
use Illuminate\Database\Eloquent\Model;

class Tabs extends Model
{
    public $table = "setting_tabs";

    public $fillable = ['name', 'id', 'sign_date'];
}
