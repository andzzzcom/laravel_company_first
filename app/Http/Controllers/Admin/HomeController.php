<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projects_m;
use Session;
use Hash;

class HomeController extends Controller
{
	public function __construct()
	{
		
	}
	
	public function home()
    {
		$data 	= $this->settings();
		$proj	= Projects_m::whereNotIn("c_projects.status_active", [-1])
					->join("c_projects_categories", "c_projects.id_category", "=", "c_projects_categories.id_category")
					->select("c_projects.*", "c_projects_categories.name as catName")
					->get();
					
		return view("Admin/home")
			->with("projects", $proj)
			->with("set", $data);
    }
	
	private function get_stats()
	{
		//order
		$total_n_order		= Order_m::all()->count();
		$total_amt_order	= Order_m::where("status_payment", "Paid")->sum("total_price");
		
		//video
		$total_video		= Video_m::where("status_active", 1)->count();
		$total_n_video		= OrderVideo_m::where("status_active", 1)->count();
		
		//subscription
		$total_subs			= Subscription_m::where("status_active", 1)->count();
		
		//customer
		$total_customer		= User_m::where("status_active", 1)->count();
		
		$return		= array(
						"n_order"=>$total_n_order,
						"amt_order"=>$total_amt_order,
						"n_video"=>$total_video,
						"n_order_video"=>$total_n_video,
						"n_subs"=>$total_subs,
						"n_cust"=>$total_customer,
					);
		return $return;
	}
}
