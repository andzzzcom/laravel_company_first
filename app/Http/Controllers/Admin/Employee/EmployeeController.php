<?php

namespace App\Http\Controllers\Admin\Employee;
use App\Http\Controllers\Controller;

use App\Models\Employees_m;
use App\Models\Designations_m;

use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;
use Session;

class EmployeeController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 3;
	}
	
	public function index()
	{
		$data	  = $this->settings();
		$emp	  = Employees_m::whereNotIn("c_employees.status_active", [-1])
					->join("c_designations", "c_employees.id_designation", "=", "c_designations.id_designation")
					->join("c_departments", "c_designations.id_department", "=", "c_departments.id_department")
					->orderBy("id_employee", "desc")
					->select("c_employees.*", "c_departments.name as depName", "c_designations.name as desName")
					->get();
		return view("Admin.employee.list")
			->with("employees", $emp)
			->with("set", $data);
	}
	
	public function add()
	{
		$data = $this->settings();
		$des  = Designations_m::where("status_active", 1)->get();
		
		return view("Admin.employee.new")
			->with("designations", $des)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_designation'=>'required',
			'name'=>'required|min:3',
			'email'=>'required|min:3:email',
			'phone'=>'required|min:5',
			'address'=>'required|min:5',
			'born_date'=>'required',
			'salary'=>'required',
			'gender'=>'required|between:0,1',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			if(request()->hasFile('photo'))
			{			
				//upload photo
				$image 			 = request()->file('photo');
				$photo		 	 = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/assets_admin/assets/theme1/images/employee/');
				$image->move($destinationPath, $photo);
				
				$id_admin 	= Session :: get ('id_admin');
				$id_des		= $req->post("id_designation");
				$name 		= $req->post("name");
				$email 		= $req->post("email");
				$phone 		= $req->post("phone");
				$address 	= $req->post("address");
				$born_date 	= $req->post("born_date");
				$salary 	= $req->post("salary");
				$gender 	= $req->post("gender");
				$status 	= $req->post("status_active");
						
				$data = array(
								"id_designation"=>$id_des,
								"name"=>$name,
								"email"=>$email,
								"phone"=>$phone,
								"address"=>$address,
								"born_date"=>$born_date,
								"salary"=>$salary,
								"photo"=>$photo,
								"gender"=>$gender,
								"status_active"=>$status,
								"creator"=>$id_admin,
								"last_updater"=>$id_admin,
							);
				$emp = (new Employees_m)->insert_data($data);
				if($emp !== null)
				{
					//insert logs
					$this->insert_logs('add');
					
					return redirect("admin/employee")->withErrors("Successfully Added!");
				}
				else
				{
					return back()->withErrors("Failed Added!");
				}
			}else{
				return back()->withErrors("Failed Added! Photo Required!");
			}
		}
	}
	
	public function edit($id)
	{
		$data = $this->settings();
		$des  = Designations_m::where("status_active", 1)->get();
		$emp  = Employees_m::whereNotIn("status_active", [-1])
				->where("id_employee", $id)
				->get();
		
		return view("Admin.employee.edit")
			->with("designations", $des)
			->with("employee", $emp)
			->with("set", $data);
	}
	
	public function edit_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_designation'=>'required',
			'name'=>'required|min:3',
			'email'=>'required|min:3:email',
			'phone'=>'required|min:5',
			'address'=>'required|min:5',
			'born_date'=>'required',
			'salary'=>'required',
			'gender'=>'required|between:0,1',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			
			$id_emp		= $req->post("id_employee");
			$id_des		= $req->post("id_designation");
			$name 		= $req->post("name");
			$email 		= $req->post("email");
			$phone 		= $req->post("phone");
			$address 	= $req->post("address");
			$born_date 	= $req->post("born_date");
			$salary 	= $req->post("salary");
			$gender 	= $req->post("gender");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_employee"=>$id_emp,
							"id_designation"=>$id_des,
							"name"=>$name,
							"email"=>$email,
							"phone"=>$phone,
							"address"=>$address,
							"born_date"=>$born_date,
							"salary"=>$salary,
							"gender"=>$gender,
							"status_active"=>$status,
							"last_updater"=>$id_admin,
						);
			
			if(request()->hasFile('photo'))
			{				
				//upload photo
				$image 			 = request()->file('photo');
				$photo		 	 = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/assets_admin/assets/theme1/images/employee/');
				$image->move($destinationPath, $photo);
				$data["photo"]	 = $photo;
			}
			
			$dep = (new Employees_m)->update_data($data);
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
		$des  = Designations_m::where("status_active", 1)->get();
		$emp  = Employees_m::whereNotIn("status_active", [-1])
				->where("id_employee", $id)
				->get();
		
		return view("Admin.employee.delete")
			->with("designations", $des)
			->with("employee", $emp)
			->with("set", $data);
	}
	
	public function delete_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_employee'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id 		= $req->post("id_employee");
					
			$data = array(
							"id_employee"=>$id,
							"status_active"=>-1,
							"last_updater"=>$id_admin,
						);
			$emp = (new Employees_m)->update_data($data);
			if($emp !== null)
			{
				//insert logs
				$this->insert_logs('delete');
				
				return redirect("admin/employee")->withErrors("Successfully Removed!");
			}
			else
			{
				return back()->withErrors("Failed Removed!");
			}
		}
	}
}
