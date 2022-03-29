<?php

namespace App\Http\Controllers\Admin\Designation;
use App\Http\Controllers\Controller;

use App\Models\Designations_m;
use App\Models\Departments_m;

use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;
use Session;

class DesignationController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 2;
	}
	
	public function index()
	{
		$data	  = $this->settings();
		$des	  = Designations_m::whereNotIn("c_designations.status_active", [-1])
					->where("c_departments.status_active", 1)
					->join("c_departments", "c_designations.id_department", "=", "c_departments.id_department")
					->select("c_designations.name as desName", "c_designations.created_date as desCreatedDate", "c_designations.last_updated as desLastUpdatedDate", "c_designations.id_department as depId", "c_designations.id_designation as desId", "c_designations.status_active as desStatus", "c_departments.name as depName")
					->get();
					
		return view("Admin.designation.list")
			->with("designations", $des)
			->with("set", $data);
	}
	
	public function by_department($id)
	{
		$data	  = $this->settings();
		$dep  	  = Departments_m::whereNotIn("status_active", [-1])
					->where("id_department", $id)
					->get();
		$des	  = Designations_m::whereNotIn("c_designations.status_active", [-1])
					->where("c_departments.status_active", 1)
					->where("c_designations.id_department", $id)
					->join("c_departments", "c_designations.id_department", "=", "c_departments.id_department")
					->select("c_designations.name as desName", "c_designations.created_date as desCreatedDate", "c_designations.last_updated as desLastUpdatedDate", "c_designations.id_department as depId", "c_designations.id_designation as desId", "c_designations.status_active as desStatus", "c_departments.name as depName")
					->get();
		return view("Admin.designation.list_by_department")
			->with("designations", $des)
			->with("department", $dep)
			->with("set", $data);
	}
	
	public function add()
	{
		$data = $this->settings();
		$dep  = Departments_m::where("status_active", 1)
				->get();
		
		return view("Admin.designation.new")
			->with("departments", $dep)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
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
			
			$id_dep		= $req->post("id_department");
			$name 		= $req->post("name");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_department"=>$id_dep,
							"name"=>$name,
							"status_active"=>$status,
							"creator"=>$id_admin,
							"last_updater"=>$id_admin,
						);
			$des = (new Designations_m)->insert_data($data);
			if($des !== null)
			{
				//insert logs
				$this->insert_logs('add');
				
				return redirect("admin/designation")->withErrors("Successfully Added!");
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
		$dep  = Departments_m::where("status_active", 1)
				->get();
		$des  = Designations_m::whereNotIn("status_active", [-1])
				->where("id_designation", $id)
				->get();
		
		return view("Admin.designation.edit")
			->with("departments", $dep)
			->with("designation", $des)
			->with("set", $data);
	}
	
	public function edit_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_designation'=>'required',
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
			
			$id_des		= $req->post("id_designation");
			$id_dep		= $req->post("id_department");
			$name 		= $req->post("name");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_department"=>$id_dep,
							"id_designation"=>$id_des,
							"name"=>$name,
							"status_active"=>$status,
							"last_updater"=>$id_admin,
						);
			$des = (new Designations_m)->update_data($data);
			if($des !== null)
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
		$dep  = Departments_m::where("status_active", 1)
				->get();
		$des  = Designations_m::whereNotIn("status_active", [-1])
				->where("id_designation", $id)
				->get();
		
		return view("Admin.designation.delete")
			->with("departments", $dep)
			->with("designation", $des)
			->with("set", $data);
	}
	
	public function delete_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_designation'=>'required',
			'id_department'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id 		= $req->post("id_designation");
					
			$data = array(
							"id_designation"=>$id,
							"status_active"=>-1,
							"last_updater"=>$id_admin,
						);
			$des = (new Designations_m)->update_data($data);
			if($des !== null)
			{
				//insert logs
				$this->insert_logs('delete');
				
				return redirect("admin/designation")->withErrors("Successfully Removed!");
			}
			else
			{
				return back()->withErrors("Failed Removed!");
			}
		}
	}
}
