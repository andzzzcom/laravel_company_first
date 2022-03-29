<?php

namespace App\Http\Controllers\Admin\Admin;
use App\Http\Controllers\Controller;
use App\Models\Role_m;
use App\Models\Admin_m;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Session;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 6;
	}
	
	public function index()
	{
		$data = $this->settings();
		
		$list = Admin_m::whereNotIn("status_active", [-1])->get();
		return view("Admin.admin.list")
			->with("admin", $list)
			->with("set", $data);
	}
	
	public function add()
	{
		$data = $this->settings();
		$role = Role_m::where("status_role", 1)->get();
		
		return view("Admin.admin.new")
			->with("role", $role)
			->with("set", $data);
	}
	
	public function add_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'email'=>'required|min:3:email',
			'name'=>'required|min:5',
			'phone'=>'required|min:5',
			'role'=>'required',
			'address'=>'required|min:5',
			'born_place'=>'required|min:5',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$type 			= 'add';
			$id_admin 		= Session :: get ('id_admin');
			
			$password 		= '12345678';
			$name 			= $req->post("name");
			$email 			= $req->post("email");
			$phone 			= $req->post("phone");
			$address 		= $req->post("address");
			$role	 		= $req->post("role");
			$gender 		= $req->post("gender");
			$born_place 	= $req->post("born_place");
			$status 		= $req->post("status_active");
					
			$image = request()->file('avatar');
			$name_image = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/assets/theme1/images/');
			$image->move($destinationPath, $name_image);
			
			$data = array(
							"name"=>$name,
							"email"=>$email,
							"avatar"=>$name_image,
							"password"=>Hash::make($password),
							"phone"=>$phone,
							"address"=>$address,
							"role"=>$role,
							"gender"=>$gender,
							"born_place"=>$born_place,
							"status_active"=>$status,
							"creator"=>$id_admin,
							"last_updater"=>$id_admin,
						);
			$gal = (new Admin_m)->insert_data($data);
			if($gal !== null)
			{
				//insert logs
				$this->insert_logs('add');
				
				return redirect("admin/admin")->withErrors("Successfully Added!");
			}
			else
			{
				return redirect("admin/admin/add")->withErrors("Failed Added!");
			}
		}
	}
	
	public function edit($id)
	{
		$data = $this->settings();
		
		$list = Admin_m::whereNotIn("status_active", [-1])
				->where("id_admin", $id)
				->get();
		if(count($list)<1)
			return redirect("not_found");
		$role = Role_m::where("status_role", 1)->get();
		
		return view("Admin.admin.edit")
			->with("role", $role)
			->with("admin", $list)
			->with("set", $data);
	}
	
	public function edit_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'id_admin'=>'required|min:1',
			'email'=>'required|min:3:email',
			'name'=>'required|min:5',
			'phone'=>'required|min:5',
			'role'=>'required',
			'address'=>'required|min:5',
			'born_place'=>'required|min:5',
			'status_active'=>'required|between:0,1'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$id_admin 		= Session :: get ('id_admin');
			
			$id 			= $req->post("id_admin");
			$name 			= $req->post("name");
			$email 			= $req->post("email");
			$phone 			= $req->post("phone");
			$address 		= $req->post("address");
			$role	 		= $req->post("role");
			$gender 		= $req->post("gender");
			$born_place 	= $req->post("born_place");
			$status 		= $req->post("status_active");
			$data = array(
							"id_admin"=>$id,
							"name"=>$name,
							"email"=>$email,
							"phone"=>$phone,
							"address"=>$address,
							"gender"=>$gender,
							"role"=>$role,
							"born_place"=>$born_place,
							"status_active"=>$status,
							"last_updater"=>$id_admin,
						);
			if(request()->hasFile('avatar'))
			{			
				$image = request()->file('avatar');
				$name_image = time().'.'.$image->getClientOriginalExtension();
				$destinationPath = public_path('/assets/theme1/images//');
				$image->move($destinationPath, $name_image);
				
				$data["avatar"] = $name_image;
				Session::put('photo_admin', $name_image);
				Session::put('name_admin', $name);
			}
			$gal = (new Admin_m)->update_data($data);
			if($gal !== null)
			{
				//insert logs
				$this->insert_logs('edit');
				
				return redirect("admin/admin/edit/".$id)->withErrors("Successfully Updated!");
			}
			else
			{
				return redirect("admin/admin/edit/".$id)->withErrors("Failed Updated!");
			}
		}
	}
	
	public function delete($id)
	{
		$data = $this->settings();
		
		$list = Admin_m::whereNotIn("status_active", [-1])
				->where("id_admin", $id)
				->get();
		if(count($list)<1)
			return redirect("not_found");
		$role = Role_m::where("status_role", 1)->get();
		return view("Admin.admin.delete")
			->with("admin", $list)
			->with("role", $role)
			->with("set", $data);
	}
	
	public function delete_act(Request $req)
    {
		$id 		= $req->post("id_admin");
		$data		= array("id_admin"=>$id, "status_active"=>-1);
		
		$gal 		= (new Admin_m)->remove_data($data);
		if($gal !== null)
		{
			//insert logs
			$this->insert_logs('delete');
				
			return redirect("admin/admin/")->withErrors("Successfully Removed!");
		}
		else
		{
			return redirect("admin/admin/delete/".$id)->withErrors("Failed Removed!");
		}
	}
	
	public function edit_password()
    {
		$data 		= $this->settings();
		$id_admin 	= Session :: get ('id_admin');
		
		return view("Admin.admin.edit_password")
			->with("id_admin", $id_admin)
			->with("set", $data);
    }
	
	public function edit_password_act(Request $req)
    {
		$msg					= "";
		$id_admin				= $req->post('id');
		$password_admin 		= $req->post('password');
		$new_password_admin 	= $req->post('new_password');
		$new_password_admin2 	= $req->post('new_password_confirm');
		
		$datas['id_admin'] 		= $id_admin;
		$checkid 				= (new Admin_m)->get_by_id($datas);
		if(count($checkid) > 0)
		{
			$datauser		= (new Admin_m)->get_by_id($datas);
			$passworduser 	= $datauser[0]->password;
			
			if(password_verify($password_admin, $passworduser))
			{
				$password_bcrypt = password_hash($new_password_admin, PASSWORD_BCRYPT);
				$dataadmin = array(
								"id_admin"=>$id_admin,
								"password"=>$password_bcrypt
							);
				$update_password = (new Admin_m)->update_data($dataadmin);
				if(!$update_password)
				{
					$msg	= "Failed Update Password !";
				}else
				{
					//insert logs
					$this->insert_logs('edit');
					
					$msg	= "Successfully Update Password !";
				}
			}else
			{
				$msg	= "Wrong Password !";
			}
		}else
		{
			$msg	= "Wrong Email / Email Not Activated !";
		}
		return redirect('admin/admin/edit_password/')->withErrors($msg);
    }
	
}
