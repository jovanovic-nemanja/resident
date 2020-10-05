<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Files extends Model
{
    public $fillable = ['request_id', 'name', 'type', 'sign_date'];

    public $table = 'files';

    public static function upload_file_rfq($request_id, $existings = null) {
        if(!request()->hasFile('files')) {
            return false;
        }

        // foreach (request()->file('files') as $key => $file) {
            Storage::disk('public_local')->put('uploads/', request()->file('files'));

            self::save_file($request_id, request()->file('files'));
        // }
    }

    public static function save_file($request_id, $file) {
    	$fl = Files::where(['request_id' => $request_id])->first();

    	if($fl) {
			Storage::disk('public_local')->delete('uploads/', $fl->name);
    		$fl->name = $file->hashName();
    		
    		$extenders = explode(".", $fl->name);
    		$extension = $extenders[1];
    		
    		$fl->type = $extension;
    		$fl->sign_date = date('Y-m-d H:i:s');
    		$fl->save();
    	} else {
    		$extenders = explode(".", $file->hashName());
    		$extension = $extenders[1];

	        Files::create([
	            'name' => $file->hashName(),
	            'request_id' => $request_id,
	            'type' => $extension,
	            'sign_date' => date('Y-m-d H:i:s'),
	        ]);
    	}
    }
}
