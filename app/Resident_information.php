<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Resident_information extends Model
{
    public $table = "resident_information";

    public $fillable = ['date_admitted', 'ssn', 'primary_language', 'representing_party_name', 'representing_party_address', 'representing_party_home_phone', 'representing_party_cell_phone', 'secondary_representative_name', 'secondary_representative_address', 'secondary_representative_home_phone', 'secondary_representative_cell_phone', 'physician_or_medical_group_name', 'physician_or_medical_group_address', 'physician_or_medical_group_phone', 'physician_or_medical_group_fax', 'pharmacy_name', 'pharmacy_address', 'pharmacy_home_phone', 'pharmacy_fax', 'dentist_name', 'dentist_address', 'dentist_home_phone', 'dentist_fax', 'advance_directive', 'polst', 'alergies', 'signDate'];
}
