<?php

namespace App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Logs_m;
use Session;
use DB;

class LogController extends Controller
{
	public function __construct()
	{
		
	}
	
	public function logs()
	{
		$data = $this->settings();
		
		$logs = Logs_m::all();
		$logs = DB::table("c_logs")
				->select("c_logs.*", "c_logs.created_date as created_date_log", "c_admins.*", "c_menus.*")
				->join("c_admins", "c_logs.id_admin", "=", "c_logs.id_admin")
				->join("c_menus", "c_menus.id_menu", "=", "c_logs.id_menu")
				->orderBy("id_log", "desc")
				->get();
		return view("Admin.setting.log")
			->with("logs", $logs)
			->with("set", $data);
	}
	
}
