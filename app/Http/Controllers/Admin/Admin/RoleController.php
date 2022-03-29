<?php

namespace App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\Menu_m;
use App\Models\Role_m;
use App\Models\RoleMenu_m;

use Illuminate\Http\Request;
use Validator;
use Session;

class RoleController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 7;
	}
	
	public function index()
	{
		$data = $this->settings();
		
		$list = Role_m::whereNotIn("status_role", [-1])->get();
		return view("Admin.role.list")
			->with("role", $list)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name_role"=>"required|min:3|max:25",
			"status_role"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$name_role 		= $req->post("name_role");
		$status_role	= $req->post("status_role");
		$data			= array(
								"name_role"=>$name_role,
								"status_role"=>$status_role,
							);	
		$insert = (new Role_m)->insert_data($data);
		if($insert)
		{
			//insert logs
			$this->insert_logs('add');
			
			return back()->withErrors("Successfully Added!");
		}else{
			return back()->withErrors("Failed Added!");
		}
	}
	
	public function detail(Request $req)
	{
		$id_role 	= $req->post("id_role");
		$role 		= Role_m::where("id_role", $id_role)->get();
		return $role;
	}
	
	public function edit_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name_role"=>"required|min:3|max:25",
			"status_role"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$id_role 		= $req->post("id_role");
		$name_role 		= $req->post("name_role");
		$status_role	= $req->post("status_role");
		$data			= array(
								"id_role"=>$id_role,
								"name_role"=>$name_role,
								"status_role"=>$status_role,
							);	
		$update = (new Role_m)->update_data($data);
		if($update)
		{
			//insert logs
			$this->insert_logs('edit');
			
			return back()->withErrors("Successfully Updated!");
		}else{
			return back()->withErrors("Failed Updated!");
		}
	}
	
	public function delete_act(Request $req)
	{
		$id 	= $req->post("id_role");
		$data	= array(
							"id_role"=>$id,
							"status_role"=>-1,
						);
		$update = (new Role_m)->update_data($data);
		if($update)
		{
			//insert logs
			$this->insert_logs('delete');
			
			return back()->withErrors("Successfully Deleted!");
		}else{
			return back()->withErrors("Failed Deleted!");
		}
	}
	
	public function role_menu(Request $req)
	{
		$id_role	= $req->post("id_role");
		$all_roles 	= RoleMenu_m::where("role_id", $id_role)->whereNotIn("status_role_menu", [-1])->get();
		
		$menu 		= Menu_m::whereNotIn("status_menu", [-1])->get();
		$res 		= $menu."-----".$all_roles;
		return $res;
	}
	
	public function status(Request $req)
	{
		$stat 		= request()->post("stat");
		$id_role 	= request()->post("id_role");
		$id_menu 	= request()->post("id_menu");
		$data_role 	= array(
						"role_id"=>$id_role,
						"menu_id"=>$id_menu,
					);
		
		if($stat == 1)
		{
			$data_role["status_role_menu"] = 1;
			$insert = (new RoleMenu_m)->insert_data($data_role);
			echo 1;
		}else
		{
			$data_role["status_role_menu"] = -1;
			$insert = (new RoleMenu_m)->update_data($data_role);
			echo 0;
		}
	}
}
