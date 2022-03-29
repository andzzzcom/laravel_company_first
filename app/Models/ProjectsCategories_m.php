<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ProjectsCategories_m extends Model
{
	
    public $table 		= "c_projects_categories";
	public $primaryKey 	= 'id_category';
   	

	public function get_by_id($data)
	{
		$admin = DB::table($this->table)
					->where("id_category", $data["id_category"])
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
			->where("id_category", $data["id_category"])
			->update($data);
	}
	
	public function remove_data($data)
	{
		$data = DB::table($this->table)
				->where("id_category", $data["id_category"])
				->update($data);
		return $data;
	}
}
