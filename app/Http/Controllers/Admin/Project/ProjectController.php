<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Projects_m;
use App\Models\ProjectsCategories_m;

use Illuminate\Http\Request;
use Validator;
use DB;
use Hash;
use Session;

class ProjectController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 4;
	}
	
	public function index()
	{
		$data	  = $this->settings();
		$proj	  = Projects_m::whereNotIn("c_projects.status_active", [-1])
					->join("c_projects_categories", "c_projects.id_category", "=", "c_projects_categories.id_category")
					->select("c_projects.*", "c_projects_categories.name as catName")
					->get();
		return view("Admin.project.list")
			->with("projects", $proj)
			->with("set", $data);
	}
	
	public function add()
	{
		$data = $this->settings();
		$cat  = ProjectsCategories_m::where("status_active", 1)->get();
		
		return view("Admin.project.new")
			->with("categories", $cat)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_category'=>'required',
			'name'=>'required|min:3',
			'start_date'=>'required',
			'duration'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id_cat		= $req->post("id_category");
			$name 		= $req->post("name");
			$start_date	= $req->post("start_date");
			$duration	= $req->post("duration");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_category"=>$id_cat,
							"name"=>$name,
							"start_date"=>$start_date,
							"duration"=>$duration,
							"status_active"=>$status,
							"creator"=>$id_admin,
							"last_updater"=>$id_admin,
						);
			$proj = (new Projects_m)->insert_data($data);
			if($proj !== null)
			{
				//insert logs
				$this->insert_logs('add');
				
				return redirect("admin/project")->withErrors("Successfully Added!");
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
		$cat  = ProjectsCategories_m::where("status_active", 1)->get();
		$proj = Projects_m::whereNotIn("status_active", [-1])
				->where("id_project", $id)
				->get();
		
		return view("Admin.project.edit")
			->with("project", $proj)
			->with("categories", $cat)
			->with("set", $data);
	}
	
	public function edit_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_project'=>'required',
			'id_category'=>'required',
			'name'=>'required|min:3',
			'start_date'=>'required',
			'duration'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id_project	= $req->post("id_project");
			$id_cat		= $req->post("id_category");
			$name 		= $req->post("name");
			$start_date	= $req->post("start_date");
			$duration	= $req->post("duration");
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_project"=>$id_project,
							"id_category"=>$id_cat,
							"name"=>$name,
							"start_date"=>$start_date,
							"duration"=>$duration,
							"status_active"=>$status,
							"creator"=>$id_admin,
							"last_updater"=>$id_admin,
						);
			$proj = (new Projects_m)->update_data($data);
			if($proj !== null)
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
		$cat  = ProjectsCategories_m::where("status_active", 1)->get();
		$proj = Projects_m::whereNotIn("status_active", [-1])
				->where("id_project", $id)
				->get();
		
		return view("Admin.project.delete")
			->with("project", $proj)
			->with("categories", $cat)
			->with("set", $data);
	}
	
	public function delete_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_project'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id 		= $req->post("id_project");
					
			$data = array(
							"id_project"=>$id,
							"status_active"=>-1,
							"last_updater"=>$id_admin,
						);
			$proj = (new Projects_m)->update_data($data);
			if($proj !== null)
			{
				//insert logs
				$this->insert_logs('delete');
				
				return redirect("admin/project")->withErrors("Successfully Removed!");
			}
			else
			{
				return back()->withErrors("Failed Removed!");
			}
		}
	}
}
