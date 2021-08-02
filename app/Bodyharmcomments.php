<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bodyharmcomments extends Model
{
    public $table = "body_harm_comments";

    public $fillable = ['name', 'clinic_id', 'template_id', 'sign_date'];
}
