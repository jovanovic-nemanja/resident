<?php

namespace App;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Vitalsign extends Model
{
    public $table = "vital_sign";

    public $fillable = ['blood_pressure', 'temperature', 'heart_rate', 'resident_id', 'sign_date'];
}
