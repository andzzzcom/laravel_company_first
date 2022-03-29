<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Admin_m;
use App\Models\User_m;
use App\Models\Category_m;
use App\Models\Discussion_m;
use App\Models\Follow_m;

use Hash;
use Validator;
use Session;
use Cookie;

class Login extends Controller
{
	public function __construct()
	{
		$this->id_menu = 6;
	}
	
    public function login()
	{
		$settings	= $this->settings();
		return view("Admin.login")
			->with("set", $settings);
	}
	
	public function login_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'email'=>'required|min:3:email',
			'password'=>'required|min:5'
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors());
		}else
		{
			$email 		= $req->email;
			$password 	= $req->password;
			$data		= array(
							"email"=>$email,
							"password"=>$password,
						);
			$login 		= (new Admin_m)->get_admin($data);
			if($login->count() > 0)
			{
				$pass_key = $login[0]->password;		
				if (Hash::check($password, $pass_key)) 
				{				
					$id_admin = $login[0]->id_admin;
					$name_admin = $login[0]->name;		
					$photo_admin = $login[0]->avatar;		
					$role = $login[0]->role;		
					Session::put('id_admin', $id_admin);
					Session::put('email_admin', $email);
					Session::put('avatar_admin', $photo_admin);
					Session::put('role_admin', $role);
					Session::put('name_admin', $name_admin);
					Session::put('csrf_admin', csrf_token());
					
					//insert logs
					$this->insert_logs('login');
					
					return redirect("admin/home");
				}else
				{
					return redirect("admin/login")->withErrors("Wrong Email/Password !");
				}
			}
			else
			{
				return redirect("admin/login")->withErrors("Wrong Email/Password !");
			}
		}
	}
	
	public function logout()
    {
		session()->flush();
		return redirect("admin/login");
    }
}
