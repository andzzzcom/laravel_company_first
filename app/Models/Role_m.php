<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Role_m extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'c_roles';
	protected $primaryKey = 'id_role';
    protected $fillable = [
        'name_role',
    ];

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
			->where("id_role", $data["id_role"])
			->update($data);
	}
	
}
