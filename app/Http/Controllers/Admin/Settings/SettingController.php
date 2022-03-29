<?php

namespace App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Settings_m;
use App\Models\SettingsEmail_m;
use Validator;
use Session;

class SettingController extends Controller
{
	public function __construct()
	{
		$this->id_menu = 9;
	}
	
	public function general()
	{
		$data = $this->settings();
		
		$list = (new Settings_m)->get_general_settings();
		return view("Admin.setting.general")
			->with("list", $list)
			->with("set", $data);
	}
	
	public function general_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'title_web'=>'required|min:3',
			'url_facebook'=>'required|min:5',
			'url_twitter'=>'required|min:5',
			'url_instagram'=>'required|min:5',
			'url_youtube'=>'required|min:5',
			'meta_title'=>'required|min:5',
			'meta_description'=>'required|min:5',
			'meta_keywords'=>'required|min:5',
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$title_web 			 = request()->post("title_web");
			$url_facebook 		 = request()->post("url_facebook");
			$url_twitter 		 = request()->post("url_twitter");
			$url_instagram 		 = request()->post("url_instagram");
			$url_youtube 		 = request()->post("url_youtube");
			$meta_title 		 = request()->post("meta_title");
			$meta_description 	 = request()->post("meta_description");
			$meta_keywords		 = request()->post("meta_keywords");
			if(request()->hasFile('favicon_web'))
			{			
				$image = request()->file('favicon_web');
				$name = $image->getClientOriginalName();
				$destinationPath = public_path('/assets_admin/assets/theme1/images/settings/');
				$image->move($destinationPath, $name);
				
				$data_settings["favicon_web"] = $name;
				$settings = (new Settings_m)->update_general_settings($data_settings);
				
			}
			
			if(request()->hasFile('logo_web'))
			{			
				$image = request()->file('logo_web');
				$name = $image->getClientOriginalName();
				$destinationPath = public_path('/assets_admin/assets/theme1/images/settings/');
				$image->move($destinationPath, $name);
				
				$data_settings["logo_web"] = $name;
				$settings = (new Settings_m)->update_general_settings($data_settings);
			}
			$data_settings = array(
								"title_web"=>$title_web,
								"url_facebook"=>$url_facebook,
								"url_twitter"=>$url_twitter,
								"url_instagram"=>$url_instagram,
								"url_youtube"=>$url_youtube,
								"meta_title"=>$meta_title,
								"meta_description"=>$meta_description,
								"meta_keywords"=>$meta_keywords,
							);
			$settings = (new Settings_m)->update_general_settings($data_settings);
			if($settings)
			{			
				//insert logs
				$this->insert_logs('edit general settings');
				
				return back()->withErrors("Successfully Updated!");
				
			}else
			{
				return back()->withErrors("Failed Updated!");
			}
		}
	}
	
	//setting email
	public function email()
	{
		$data = $this->settings();
		
		$list = SettingsEmail_m::where("status_active", 1)->get();
		return view("Admin.setting.email")
			->with("list", $list)
			->with("set", $data);
	}
	
	
	public function email_act(Request $req)
	{
		$validator = Validator::make($req->all(), [
			'mail_type'=>'required|min:1',
			'mail_host'=>'required|min:1',
			'mail_username'=>'required|min:3',
			'mail_password'=>'required|min:3',
			'mail_port'=>'required|min:1',
			'mail_encryption'=>'required|min:1',
		]);
		
		if($validator->fails())
		{
			return back()->withErrors($validator->errors())->withInput();
		}else
		{
			$mail_type 		 = request()->post("mail_type");
			$mail_host 		 = request()->post("mail_host");
			$mail_username 	 = request()->post("mail_username");
			$mail_password 	 = request()->post("mail_password");
			$mail_port 		 = request()->post("mail_port");
			$mail_encryption  = request()->post("mail_encryption");
			$data_settings = array(
								"mail_type"=>$mail_type,
								"mail_host"=>$mail_host,
								"mail_username"=>$mail_username,
								"mail_password"=>$mail_password,
								"mail_port"=>$mail_port,
								"mail_encryption"=>$mail_encryption,
								"status_active"=>1,
							);
			$settings = (new SettingsEmail_m)->update_data($data_settings);
			if($settings)
			{			
				//insert logs
				$this->insert_logs('edit email settings');
				
				return back()->withErrors("Successfully Updated!");
				
			}else
			{
				return back()->withErrors("Failed Updated!");
			}
		}
	}
	
}
