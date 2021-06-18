<?php

namespace App;

use App\User;
use App\FieldTypes;
use Illuminate\Database\Eloquent\Model;

class FieldTypes extends Model
{
    public $table = "field_types";

    public $fillable = ['typeName', 'id', 'fieldID', 'sign_date_field_type'];
}
