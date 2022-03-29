<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Projects_m;
use App\Models\Employees_m;
use App\Models\ProjectsMembers_m;

use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;
use Session;

class ProjectMemberController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 4;
	}
	
	public function index($id)
	{
		$data	  = $this->settings();
		$proj	  = Projects_m::where("status_active", 1)
					->where("id_project", $id)
					->get();
		$emp	  = Employees_m::where("c_employees.status_active", 1)
					->join("c_designations", "c_employees.id_designation", "=", "c_designations.id_designation")
					->join("c_departments", "c_designations.id_department", "=", "c_departments.id_department")
					->select("c_designations.name as designationName", "c_departments.name as departmentName", "c_employees.*")
					->get();
		$rel	  = ProjectsMembers_m::whereNotIn("status_active", [-1])
					->where("id_project", $id)
					->get();
		return view("Admin.project.member.list_member")
			->with("employees", $emp)
			->with("relations", $rel)
			->with("project", $proj)
			->with("set", $data);
	}
	
	public function all($id)
	{
		$data	  = $this->settings();
		$proj	  = Projects_m::where("status_active", 1)
					->where("id_project", $id)
					->get();
		$emp	  = Employees_m::where("c_employees.status_active", 1)
					->join("c_projects_members", "c_employees.id_employee", "=", "c_projects_members.id_employee")
					->join("c_designations", "c_employees.id_designation", "=", "c_designations.id_designation")
					->join("c_departments", "c_designations.id_department", "=", "c_departments.id_department")
					->select("c_designations.name as designationName", "c_departments.name as departmentName", "c_employees.*")
					->where("c_projects_members.id_project", $id)
					->where("c_projects_members.status_active", 1)
					->get();
		return view("Admin.project.member.list")
			->with("employees", $emp)
			->with("project", $proj)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$id		    = $req->id;
		$id_proj    = $req->id_proj;
		$relations 	= ProjectsMembers_m::whereNotIn("status_active", [-1])
						->where("id_employee", $id)
						->where("id_project", $id_proj)
						->get();
		if(count($relations)>0)
		{
			if($relations[0]->status_active == 0)
			{
				$data["status_active"]	= 1;
			}else{
				$data["status_active"]	= 0;
			}
			
			$data["id_project"]		= $id_proj;
			$data["id_employee"]	= $id;
			(new ProjectsMembers_m)->update_data($data);
			
			//insert logs
			$this->insert_logs('edit member');
		}else
		{
			$data["status_active"]	= 1;
			$data["id_project"]		= $id_proj;
			$data["id_employee"]	= $id;
			$data["creator"]		= Session::get("id_admin");
			$data["last_updater"]	= Session::get("id_admin");
			(new ProjectsMembers_m)->insert_data($data);
			
			//insert logs
			$this->insert_logs('insert member');
		}
		
		echo json_encode($relations);
	}
}
