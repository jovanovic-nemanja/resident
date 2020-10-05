<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    public $fillable = ['sender_address', 'receiver_address', 'header', 'title', 'description', 'sign_date'];

    public $table = 'emails';
}
