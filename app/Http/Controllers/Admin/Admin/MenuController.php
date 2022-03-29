<?php

namespace App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\Menu_m;

use Illuminate\Http\Request;
use Validator;
use Session;

class MenuController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 8;
	}
	
	public function index()
	{
		$data = $this->settings();
		
		$list = Menu_m::whereNotIn("status_menu", [-1])->get();
		return view("Admin.role.menu.list")
			->with("menu", $list)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name_menu"=>"required|min:3|max:100",
			"status_menu"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$name_menu 		= $req->post("name_menu");
		$status_menu	= $req->post("status_menu");
		$data			= array(
								"name_menu"=>$name_menu,
								"status_menu"=>$status_menu,
							);	
		$insert = (new Menu_m)->insert_data($data);
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
		$id_menu 	= $req->post("id_menu");
		$menu 		= Menu_m::where("id_menu", $id_menu)->get();
		return $menu;
	}
	
	public function edit_act(Request $req)
	{
		$check = Validator::make($req->all(), [
			"name_menu"=>"required|min:3|max:100",
			"status_menu"=>"required|between:0,1",
		]);
		if($check->fails())
			return back()->withErrors($check->errors())->withInput();
		
		$id_menu 		= $req->post("id_menu");
		$name_menu 		= $req->post("name_menu");
		$status_menu	= $req->post("status_menu");
		$data			= array(
								"id_menu"=>$id_menu,
								"name_menu"=>$name_menu,
								"status_menu"=>$status_menu,
							);	
		$update = (new Menu_m)->update_data($data);
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
		$id 	= $req->post("id_menu");
		$data	= array(
							"id_menu"=>$id,
							"status_menu"=>-1,
						);
		$update = (new Menu_m)->update_data($data);
		if($update)
		{
			//insert logs
			$this->insert_logs('delete');
			
			return back()->withErrors("Successfully Updated!");
		}else{
			return back()->withErrors("Failed Updated!");
		}
	}
	
	public function menu()
	{
		$method	= 'GET';
		$path 	= 'menu/list';
		$role 	= $this->_api(3, $path);
		if($role["code"]!==200)
			return redirect("admin/login");
			
		$settings	= $this->settings_admin();	
		return view("Admin.role.menu.list")
			->with("set", $settings)
			->with("menu", $menu["data"]);
	}
}
