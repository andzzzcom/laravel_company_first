<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Admin_m;
use App\Models\User_m;

use Hash;
use Validator;
use Session;
use Cookie;

class Forgot extends Controller
{
	public function _construct()
	{
		
	}
	
    public function forgot()
	{
		$settings	= $this->settings();
		return view("Admin.auth.forgot.forgot")
			->with("set", $settings);
	}
	
	public function forgot_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'email'=>'required|min:5|max:200',
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors());
		}else
		{
			$email 		= $req->email;
			$data		= array(
							"email"=>$email,
						);
			$user 		= (new Admin_m)->get_admin($data);
			if(count($user) > 0)
			{
				$email			= $email;
				$token_reset	= $user[0]->token_reset;
				$datas["link"] 	= url('admin/reset_pass/'.$email.'/'.$token_reset);
				$datas["email"]	= $email;
				
				$this->send_email_forgot($datas);
				
				return back()->withErrors("Check Your Email to Reset Password!");
			}
			else{
				return back()->withErrors("Wrong Email/Password!");
			}
		}
	}
	
	public function reset_pass($email, $token)
	{
		$data		= array(
						"email"=>$email,
						"token_reset"=>$token,
					);
		$user 		= (new Admin_m)->get_admin($data);
		if(count($user) >0)
		{
			$settings	= $this->settings();
			return view("Admin.auth.forgot.reset_pass")
				->with("id", $user[0]->id_admin)
				->with("email", $email)
				->with("token", $token)
				->with("set", $settings);
		}
		else{
			return redirect("not_found");
		}
	}
	
	public function reset_pass_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
			'password_confirmation'=>'required|min:5',
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors());
		}else
		{
			$id		 					= $req->id;
			$email	 					= $req->email;
			$token	 					= $req->token;
			$password 					= $req->password;
			$data 		= array(
							"id_admin"=>$id,
							"password"=>Hash::make($password),
						);
			
			$update = (new Admin_m)->update_data($data);
			if($update)
			{
				return back()->withErrors("Password Successfully Changed!");
			}else{
				return back()->withErrors("Password Failed Changed!");
			}
		}
	}
}
