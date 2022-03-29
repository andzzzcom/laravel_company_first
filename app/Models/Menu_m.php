<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Menu_m extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'c_menus';
	protected $primaryKey = 'id_menu';

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
			->where("id_menu", $data["id_menu"])
			->update($data);
	}
}
