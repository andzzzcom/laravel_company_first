<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use DB;

class RoleMenu_m extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'c_roles_menus';
	protected $primaryKey = 'id_role_menu';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
	
	public function insert_data($data)
	{
		return DB::table($this->table)->insert($data);
	}
	
	public function update_data($data)
	{
		return DB::table($this->table)
			->where("role_id", $data["role_id"])
			->where("menu_id", $data["menu_id"])
			->update($data);
	}
	
	public function remove_data($data)
	{
		return DB::table($this->table)
			->where("role_id", $data["role_id"])
			->where("menu_id", $data["menu_id"])
			->delete();
	}
	
    public function get_all_menu_by_role($id_role)
    {
		$permission = DB::table($this->table)->where("role_id", $id_role)->whereNotIn("status_role_menu", [-1])->get();
		return $permission;
    }
}
