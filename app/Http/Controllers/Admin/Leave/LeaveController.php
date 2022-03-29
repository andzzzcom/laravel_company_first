<?php

namespace App\Http\Controllers\Admin\Leave;
use App\Http\Controllers\Controller;

use App\Models\Leaves_m;
use App\Models\Employees_m;
use App\Models\Designations_m;

use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;
use Session;

class LeaveController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 5;
	}
	
	public function index()
	{
		$data	  = $this->settings();
		$lea	  = Leaves_m::whereNotIn("c_leaves.status_active", [-1])
					->join("c_employees", "c_leaves.id_employee", "=", "c_employees.id_employee")
					->join("c_designations", "c_employees.id_designation", "=", "c_designations.id_designation")
					->join("c_departments", "c_designations.id_department", "=", "c_departments.id_department")
					->select("c_leaves.*", "c_designations.name as desName", "c_departments.name as depName", "c_employees.name as empName")
					->get();
					
		return view("Admin.leave.list")
			->with("leaves", $lea)
			->with("set", $data);
	}
	
	public function add()
	{
		$data = $this->settings();
		$emp  = Employees_m::where("status_active", 1)->get();
		
		return view("Admin.leave.new")
			->with("employees", $emp)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_employee'=>'required',
			'start_date'=>'required',
			'end_date'=>'required',
			'reason'=>'required|min:3',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id_emp		= $req->post("id_employee");
			$start_date	= $req->post("start_date");
			$end_date 	= $req->post("end_date");
			$reason 	= $req->post("reason");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_employee"=>$id_emp,
							"start_date"=>$start_date,
							"end_date"=>$end_date,
							"reason"=>$reason,
							"status_active"=>$status,
							"creator"=>$id_admin,
							"last_updater"=>$id_admin,
						);
			$lea = (new Leaves_m)->insert_data($data);
			if($lea !== null)
			{
				//insert logs
				$this->insert_logs('add');
				
				return redirect("admin/leave")->withErrors("Successfully Added!");
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
		$emp  = Employees_m::where("status_active", 1)->get();
		$lea  = Leaves_m::whereNotIn("status_active", [-1])
				->where("id_leave", $id)
				->get();
		
		return view("Admin.leave.edit")
			->with("employees", $emp)
			->with("leave", $lea)
			->with("set", $data);
	}
	
	public function edit_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_leave'=>'required',
			'id_employee'=>'required',
			'start_date'=>'required',
			'end_date'=>'required',
			'reason'=>'required|min:3',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id_leave	= $req->post("id_leave");
			$id_emp		= $req->post("id_employee");
			$start_date	= $req->post("start_date");
			$end_date 	= $req->post("end_date");
			$reason 	= $req->post("reason");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_leave"=>$id_leave,
							"id_employee"=>$id_emp,
							"start_date"=>$start_date,
							"end_date"=>$end_date,
							"reason"=>$reason,
							"status_active"=>$status,
							"creator"=>$id_admin,
							"last_updater"=>$id_admin,
						);
			$lea = (new Leaves_m)->update_data($data);
			if($lea !== null)
			{
				//insert logs
				$this->insert_logs('add');
				
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
		$emp  = Employees_m::where("status_active", 1)->get();
		$lea  = Leaves_m::whereNotIn("status_active", [-1])
				->where("id_leave", $id)
				->get();
		
		return view("Admin.leave.delete")
			->with("employees", $emp)
			->with("leave", $lea)
			->with("set", $data);
	}
	
	public function delete_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_leave'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id 		= $req->post("id_leave");
					
			$data = array(
							"id_leave"=>$id,
							"status_active"=>-1,
							"last_updater"=>$id_admin,
						);
			$lea = (new Leaves_m)->update_data($data);
			if($lea !== null)
			{
				//insert logs
				$this->insert_logs('add');
				
				return redirect("admin/leave")->withErrors("Successfully Removed!");
			}
			else
			{
				return back()->withErrors("Failed Removed!");
			}
		}
	}
}
