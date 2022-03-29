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

class ProjectCategoryController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 4;
	}
	
	public function index()
	{
		$data	  = $this->settings();
		$cat	  = ProjectsCategories_m::whereNotIn("status_active", [-1])
					->get();
		return view("Admin.project.category.list")
			->with("categories", $cat)
			->with("set", $data);
	}
	
	public function add()
	{
		$data = $this->settings();
		
		return view("Admin.project.category.new")
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
			if(request()->hasFile('thumbnail'))
			{			
				//upload photo
				$image 			 = request()->file('thumbnail');
				$thumbnail	 	 = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/assets_admin/assets/theme1/images/project/category/');
				$image->move($destinationPath, $thumbnail);
				
				$id_admin 	= Session :: get ('id_admin');
				$name 		= $req->post("name");
				$status 	= $req->post("status_active");
						
				$data = array(
								"name"=>$name,
								"thumbnail"=>$thumbnail,
								"status_active"=>$status,
								"creator"=>$id_admin,
								"last_updater"=>$id_admin,
							);
				$cat = (new ProjectsCategories_m)->insert_data($data);
				if($cat !== null)
				{
					//insert logs
					$this->insert_logs('add');
					
					return redirect("admin/project/category")->withErrors("Successfully Added!");
				}
				else
				{
					return back()->withErrors("Failed Added!");
				}
			}else{
				return back()->withErrors("Failed Added! Thumbnail Required!");
			}
		}
	}
	
	public function edit($id)
	{
		$data = $this->settings();
		$cat  = ProjectsCategories_m::whereNotIn("status_active", [-1])
				->where("id_category", $id)
				->get();
		
		return view("Admin.project.category.edit")
			->with("category", $cat)
			->with("set", $data);
	}
	
	public function edit_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_category'=>'required',
			'name'=>'required|min:3',
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
			$status 	= $req->post("status_active");
					
			$data = array(
							"id_category"=>$id_cat,
							"name"=>$name,
							"status_active"=>$status,
							"last_updater"=>$id_admin,
						);
			
			if(request()->hasFile('thumbnail'))
			{				
				//upload photo
				$image 			  = request()->file('thumbnail');
				$thumbnail	 	  = time().'.'.$image->getClientOriginalExtension();
				$destinationPath  = public_path('/assets_admin/assets/theme1/images/project/category/');
				$image->move($destinationPath, $thumbnail);
				$data["thumbnail"]= $thumbnail;
			}
			
			$dep = (new ProjectsCategories_m)->update_data($data);
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
		$cat  = ProjectsCategories_m::whereNotIn("status_active", [-1])
				->where("id_category", $id)
				->get();
		
		return view("Admin.project.category.delete")
			->with("category", $cat)
			->with("set", $data);
	}
	
	public function delete_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_category'=>'required',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 	= Session :: get ('id_admin');
			$id 		= $req->post("id_category");
					
			$data = array(
							"id_category"=>$id,
							"status_active"=>-1,
							"last_updater"=>$id_admin,
						);
			$proj = (new ProjectsCategories_m)->update_data($data);
			if($proj !== null)
			{
				//insert logs
				$this->insert_logs('delete');
				
				return redirect("admin/project/category")->withErrors("Successfully Removed!");
			}
			else
			{
				return back()->withErrors("Failed Removed!");
			}
		}
	}
}
