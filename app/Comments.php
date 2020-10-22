<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $table = "comments";

    public $fillable = ['name', 'type', 'ref_id', 'sign_date'];
}
