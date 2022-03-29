<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SettingsEmail_m extends Model
{
	public $suf 		= "_setting_email";
    public $table 		= "c_settings_email";
	public $primaryKey 	= 'id_setting_email';
	public $timestamps 	= false;
		
	public function update_data($data)
	{
		$settings = DB::table($this->table)
					->where("id".$this->suf, 1)
					->update($data);
		return true;
	}
}
