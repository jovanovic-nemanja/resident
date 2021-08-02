<?php

namespace App;

use App\User;
use App\Fields;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    public $table = "fields";

    public $fillable = ['fieldName', 'clinic_id', 'template_id', 'tab_id', 'sign_date_field'];
}
