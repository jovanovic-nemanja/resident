<?php

namespace App;

use App\User;
use App\Groups;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    public $table = "groups";

    public $fillable = ['title', 'id', 'tabId', 'sign_date_group'];
}
