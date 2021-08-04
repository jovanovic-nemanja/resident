<?php

namespace App;

use App\User;
use App\Templates;
use App\ReportClone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ReportClone extends Model
{
    public $table = "report_clone";

    public $fillable = ['user_id', 'template_id', 'sign_date'];

    /**
     * get the result of log the clone the template
     * @param template id, user id
     * @author Nemanja
     * @since 2021-08-04
     * @return true or false Boolean
     */
    public static function getLog($template_id, $userid)
    {
        $record = ReportClone::where('template_id', $template_id)->where('user_id', $userid)->first();
        if (@$record) {
            return false;
        }
        
        return true;
    }
}
