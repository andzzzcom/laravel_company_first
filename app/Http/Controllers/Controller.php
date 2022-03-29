<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Session;
use App\Models\RoleMenu_m;
use App\Models\Settings_m;
use App\Models\Logs_m;

use App\Traits\Email;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Email;
	
	public $id_menu;
	public function __construct()
	{
		date_default_timezone_set('Asia/Jakarta');
	}
	
	public function settings()
	{
		$general_settings 				= (new Settings_m)->get_general_settings();
		$settings["meta_description"]	= $general_settings[0]->meta_description;
		$settings["meta_title"] 		= $general_settings[0]->meta_title;
		$settings["meta_keywords"] 		= $general_settings[0]->meta_keywords;
		$settings["favicon_web"] 		= $general_settings[0]->favicon_web;
		$settings["logo_web"] 			= $general_settings[0]->logo_web;
		$settings["title_web"]			= $general_settings[0]->title_web;
		$settings["subtitle_web"] 		= $general_settings[0]->subtitle_web;
		$settings["url_facebook"] 		= $general_settings[0]->url_facebook;
		$settings["url_twitter"] 		= $general_settings[0]->url_twitter;
		$settings["url_instagram"] 		= $general_settings[0]->url_instagram;
		$settings["url_youtube"] 		= $general_settings[0]->url_youtube;
		$settings["address"]	 		= $general_settings[0]->address;
		$settings["phone"] 				= $general_settings[0]->phone;
		$settings["email"] 				= $general_settings[0]->email;
		
		$settings["csrf_admin"] 		= Session::get("csrf_admin");
		
		
		//check permission
		if(Session::has("role_admin"))
		{
			$role_menu  = RoleMenu_m::where("role_id", Session::get("role_admin"))
							->join("c_menus", "c_roles_menus.menu_id", "=", "c_menus.id_menu")
							->where("status_role_menu", 1)
							->get();
			$settings["role_menu"]	= $role_menu;
		}
		return $settings;
	}
	
	public function insert_logs($act)
	{
		$data = array(
					"ip_address"=>request()->ip(),
					"id_admin"=>Session::get('id_admin'),
					"id_menu"=>$this->id_menu,
					"action"=>$act,
				);
		(new Logs_m)->insert_data($data);
	}
	
    public function send_email_order($invoiceCode, $type, $va_number=null)
	{
		$type			= ($type==0)?'Unpaid':'Paid';
		$order		 	= Order_m::where("invoice_code", $invoiceCode)
							->get();
							
		$qty			= 1;
		$currentURL 	= url('/');
		$detail_payment	= (new SettingsDuitku_m)->get_description($order[0]->payment_method);
		
		$detail_subs	= (new Subscription_m)->get_subs_detail($order[0]->id_subs_type);
		$name			= ($detail_subs[0]->type=='duration')?
								'(Duration Based: '.$detail_subs[0]->duration.' Months)':
								'(Token Based: '.$detail_subs[0]->token_amount.')';
		
		$data_email 	= array(
							'type'			 => $type,
							'name' 			 => $name,
							'quantity' 		 => $qty,
							'link'			 => $currentURL,
							'invoice_code'	 => $invoiceCode,
							'email' 		 => $order[0]->email_customer,
							'phoneNumber' 	 => $order[0]->phone_customer,
							'customerVaName' => $order[0]->name_customer,
							'price' 		 => $order[0]->total_price,
							'va'			 => $detail_payment[0]->description_payment,
							'va_number'		 => ($va_number==null)?null:$va_number,
						);
		$this->send_email_helper($data_email);
	}
	
    public function send_email_forgot($data)
	{
		$data_email 	= array(
							'link'			 => $data['link'],
							'email' 		 => $data['email'],
						);
		$this->send_email_helper($data_email);
	}
	
    public function send_email_helper($data)
	{
		/*
		code for email
			1: forgot password
			2: transaction: after purchase (not paid)
			3: transaction: after purchase (paid)
		*/
		
		//set config email
		$this->setMailConfig();
		Mail::to($data["email"])
			->send(new SendEmail($data));
	}
}
