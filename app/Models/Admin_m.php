<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Admin_m extends Model
{
	
    public $table 		= "c_admins";
	public $primaryKey 	= 'id_admin';
   	

	public function get_by_id($data)
	{
		$admin = DB::table($this->table)
					->where("id_admin", $data["id_admin"])
					->where("status_active", 1)
					->get();
		return $admin;
	}	
	
	public function get_admin($data)
	{
		$admin = DB::table($this->table)
					->where("email", $data["email"])
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
			->where("id_admin", $data["id_admin"])
			->update($data);
	}
	
	public function remove_data($data)
	{
		$data = DB::table($this->table)
				->where("id_admin", $data["id_admin"])
				->update($data);
		return $data;
	}
}
