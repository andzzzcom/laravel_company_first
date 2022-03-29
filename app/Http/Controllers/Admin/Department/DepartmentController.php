<?php

namespace App\Http\Controllers\Admin\Department;
use App\Http\Controllers\Controller;

use App\Models\Departments_m;

use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;
use Session;

class DepartmentController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 1;
	}
	
	public function index()
	{
		$data	  = $this->settings();
		$dep	  = Departments_m::whereNotIn("status_active", [-1])->get();
		return view("Admin.department.list")
			->with("departments", $dep)
			->with("set", $data);
	}
	
	public function add()
	{
		$data = $this->settings();
		
		return view("Admin.department.new")
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'name'=>'required|min:3',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			
			$name 		= $req->post("name");
			$status 	= $req->post("status_active");
					
			$data = array(
							"name"=>$name,
							"status_active"=>$status,
							"creator"=>$id_admin,
							"last_updater"=>$id_admin,
						);
			$dep = (new Departments_m)->insert_data($data);
			if($dep !== null)
			{
				//insert logs
				$this->insert_logs('add');
				
				return redirect("admin/department")->withErrors("Successfully Added!");
			}
			else
			{
				return back()->withErrors("Failed Added!");
			}
		}
	}
	
	public function edit($id)
	{
		$data = $this->settings();
		$dep  = Departments_m::whereNotIn("status_active", [-1])
				->where("id_department", $id)
				->get();
		
		return view("Admin.department.edit")
			->with("department", $dep)
			->with("set", $data);
	}
	
	public function edit_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_department'=>'required',
			'name'=>'required|min:3',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			
			$id 		= $req->post("id_department");
			$name 		= $req->post("name");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_department"=>$id,
							"name"=>$name,
							"status_active"=>$status,
							"last_updater"=>$id_admin,
						);
			$dep = (new Departments_m)->update_data($data);
			if($dep !== null)
			{
				//insert logs
				$this->insert_logs('edit');
				
				return back()->withErrors("Successfully Updated!");
			}
			else
			{
				return back()->withErrors("Failed Updated!");
			}
		}
	}
	
	public function delete($id)
	{
		$data = $this->settings();
		$dep  = Departments_m::whereNotIn("status_active", [-1])
				->where("id_department", $id)
				->get();
		
		return view("Admin.department.delete")
			->with("department", $dep)
			->with("set", $data);
	}
	
	public function delete_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_department'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id 		= $req->post("id_department");
					
			$data = array(
							"id_department"=>$id,
							"status_active"=>-1,
							"last_updater"=>$id_admin,
						);
			$dep = (new Departments_m)->update_data($data);
			if($dep !== null)
			{
				//insert logs
				$this->insert_logs('delete');
				
				return redirect("admin/department")->withErrors("Successfully Removed!");
			}
			else
			{
				return back()->withErrors("Failed Removed!");
			}
		}
	}
}
