<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Departments_m extends Model
{
	
    public $table 		= "c_departments";
	public $primaryKey 	= 'id_department';
   	

	public function get_by_id($data)
	{
		$admin = DB::table($this->table)
					->where("id_department", $data["id_department"])
					->where("status_active", 1)
					->get();
		return $admin;
	}	

	public function insert_data($data)
	{
		return DB::table($this->table)->insertGetId($data);
	}
	
	public function update_data($data)
	{
		return DB::table($this->table)
			->where("id_department", $data["id_department"])
			->update($data);
	}
	
	public function remove_data($data)
	{
		$data = DB::table($this->table)
				->where("id_department", $data["id_department"])
				->update($data);
		return $data;
	}
}
