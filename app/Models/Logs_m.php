<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Logs_m extends Model
{
	public $suf 		= "_log";
    public $table 		= "c_logs";
	public $primaryKey 	= 'id_log';
	public $timestamps 	= false;
	
	public function insert_data($data)
	{
		return DB::table($this->table)->insertGetId($data);
	}
}
