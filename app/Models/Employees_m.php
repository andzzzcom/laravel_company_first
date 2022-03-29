<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Employees_m extends Model
{
	
    public $table 		= "c_employees";
	public $primaryKey 	= 'id_employee';
   	

	public function get_by_id($data)
	{
		$admin = DB::table($this->table)
					->where("id_employee", $data["id_employee"])
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
			->where("id_employee", $data["id_employee"])
			->update($data);
	}
	
	public function remove_data($data)
	{
		$data = DB::table($this->table)
				->where("id_employee", $data["id_employee"])
				->update($data);
		return $data;
	}
}
