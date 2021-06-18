<?php

namespace App;

use App\User;
use App\Fields;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    public $table = "fields";

    public $fillable = ['fieldName', 'group_id', 'sign_date_field'];
}
