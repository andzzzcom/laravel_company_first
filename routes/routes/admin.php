<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//admin panel routes
Route::get("admin/login", "Admin\Auth\Login@login");
Route::post("admin/login", "Admin\Auth\Login@login_act");

Route::get("admin/forgot", "Admin\Auth\Forgot@forgot");
Route::post("admin/forgot", "Admin\Auth\Forgot@forgot_act");
Route::get("admin/reset_pass/{email}/{token}", "Admin\Auth\Forgot@reset_pass");
Route::post("admin/reset_pass", "Admin\Auth\Forgot@reset_pass_act");

Route::group(['middleware'=>'authadmin'], function(){
	Route::group(['prefix'=>'admin'], function(){
		
		Route::get("home", "Admin\HomeController@home");
		Route::get("logout", "Admin\Auth\Login@logout");
		
		//department
		Route::group(['prefix'=>'department'], function(){
			Route::get("/", "Admin\Department\DepartmentController@index");
			Route::get("/add", "Admin\Department\DepartmentController@add");
			Route::post("/add", "Admin\Department\DepartmentController@add_act");
			Route::get("/edit/{id}", "Admin\Department\DepartmentController@edit");
			Route::post("/edit", "Admin\Department\DepartmentController@edit_act");
			Route::get("/delete/{id}", "Admin\Department\DepartmentController@delete");
			Route::post("/delete", "Admin\Department\DepartmentController@delete_act");
		});
		
		//designation
		Route::group(['prefix'=>'designation'], function(){
			Route::get("/", "Admin\Designation\DesignationController@index");
			Route::get("/department/{id}", "Admin\Designation\DesignationController@by_department");
			Route::get("/add", "Admin\Designation\DesignationController@add");
			Route::post("/add", "Admin\Designation\DesignationController@add_act");
			Route::get("/edit/{id}", "Admin\Designation\DesignationController@edit");
			Route::post("/edit", "Admin\Designation\DesignationController@edit_act");
			Route::get("/delete/{id}", "Admin\Designation\DesignationController@delete");
			Route::post("/delete", "Admin\Designation\DesignationController@delete_act");
		});
		
		//employee
		Route::group(['prefix'=>'employee'], function(){
			Route::get("/", "Admin\Employee\EmployeeController@index");
			Route::get("/add", "Admin\Employee\EmployeeController@add");
			Route::post("/add", "Admin\Employee\EmployeeController@add_act");
			Route::get("/edit/{id}", "Admin\Employee\EmployeeController@edit");
			Route::post("/edit", "Admin\Employee\EmployeeController@edit_act");
			Route::get("/delete/{id}", "Admin\Employee\EmployeeController@delete");
			Route::post("/delete", "Admin\Employee\EmployeeController@delete_act");
		});
		
		//project
		Route::group(['prefix'=>'project'], function(){
		
			Route::get("/", "Admin\Project\ProjectController@index");
			Route::get("/add", "Admin\Project\ProjectController@add");
			Route::post("/add", "Admin\Project\ProjectController@add_act");
			Route::get("/edit/{id}", "Admin\Project\ProjectController@edit");
			Route::post("/edit", "Admin\Project\ProjectController@edit_act");
			Route::get("/delete/{id}", "Admin\Project\ProjectController@delete");
			Route::post("/delete", "Admin\Project\ProjectController@delete_act");
			
			//project's category
			Route::group(['prefix'=>'category'], function(){
				Route::get("/", "Admin\Project\ProjectCategoryController@index");
				Route::get("/add", "Admin\Project\ProjectCategoryController@add");
				Route::post("/add", "Admin\Project\ProjectCategoryController@add_act");
				Route::get("/edit/{id}", "Admin\Project\ProjectCategoryController@edit");
				Route::post("/edit", "Admin\Project\ProjectCategoryController@edit_act");
				Route::get("/delete/{id}", "Admin\Project\ProjectCategoryController@delete");
				Route::post("/delete", "Admin\Project\ProjectCategoryController@delete_act");
			});
			
			//project's member
			Route::group(['prefix'=>'member'], function(){
				Route::get("/list/{id}", "Admin\Project\ProjectMemberController@index");
				Route::get("/all/{id}", "Admin\Project\ProjectMemberController@all");
				Route::post("/add", "Admin\Project\ProjectMemberController@add_act");
				Route::post("/edit", "Admin\Project\ProjectMemberController@edit_act");
				Route::post("/delete", "Admin\Project\ProjectMemberController@delete_act");
			});
		});
		
		//leave
		Route::group(['prefix'=>'leave'], function(){
			Route::get("/", "Admin\Leave\LeaveController@index");
			Route::get("/add", "Admin\Leave\LeaveController@add");
			Route::post("/add", "Admin\Leave\LeaveController@add_act");
			Route::get("/edit/{id}", "Admin\Leave\LeaveController@edit");
			Route::post("/edit", "Admin\Leave\LeaveController@edit_act");
			Route::get("/delete/{id}", "Admin\Leave\LeaveController@delete");
			Route::post("/delete", "Admin\Leave\LeaveController@delete_act");
		});
		
		//admin
		Route::group(["prefix"=>"admin"], function(){
			Route::get('/', 'Admin\Admin\AdminController@index');
			Route::get("/add", "Admin\Admin\AdminController@add");
			Route::post("/add", "Admin\Admin\AdminController@add_act");
			Route::get("/edit/{id_admin}", "Admin\Admin\AdminController@edit");
			Route::post("/edit", "Admin\Admin\AdminController@edit_act");
			Route::get("/delete/{id_admin}", "Admin\Admin\AdminController@delete");
			Route::post("/delete", "Admin\Admin\AdminController@delete_act");
			Route::get("/edit_password", "Admin\Admin\AdminController@edit_password");
			Route::post("/edit_password", "Admin\Admin\AdminController@edit_password_act");
		});

		//settings
		Route::group(["prefix"=>"setting"], function(){
			Route::get('/general', 'Admin\Settings\SettingController@general');
			Route::post('/general', 'Admin\Settings\SettingController@general_act');
			
			Route::get('/wordpress', 'Admin\Settings\SettingController@wordpress');
			Route::post('/wordpress', 'Admin\Settings\SettingController@wordpress_act');
			
			Route::get('/logs', 'Admin\Settings\LogController@logs');
			
			Route::get('/email', 'Admin\Settings\SettingController@email');
			Route::post('/email', 'Admin\Settings\SettingController@email_act');
			
			Route::get('/duitku', 'Admin\Settings\SettingController@payment_duitku');
			Route::get('/duitku/edit/{id}', 'Admin\Settings\SettingController@edit_payment_duitku');
			Route::post('/duitku/edit', 'Admin\Settings\SettingController@edit_payment_duitku_act');
			Route::post('/duitku/status', 'Admin\Settings\SettingController@edit_payment_duitku_status');
			
			Route::post('/duitku/credential/edit', 'Admin\Settings\SettingController@edit_duitku_credential');
		});
	
		//role
		Route::group(["prefix"=>"role"], function(){
			Route::get('/', 'Admin\Admin\RoleController@index');
			Route::post('/add_act', 'Admin\Admin\RoleController@add_act');
			Route::post('/detail', 'Admin\Admin\RoleController@detail');
			Route::post('/edit_act', 'Admin\Admin\RoleController@edit_act');
			Route::get('/delete/{id_role}', 'Admin\Admin\RoleController@delete');
			Route::post('/delete_act', 'Admin\Admin\RoleController@delete_act');
			Route::post('/status', 'Admin\Admin\RoleController@status');
		});
		
		//menu
		Route::group(["prefix"=>"menu"], function(){
			Route::get('/', 'Admin\Admin\MenuController@index');
			Route::post('/add_act', 'Admin\Admin\MenuController@add_act');
			Route::post('/detail', 'Admin\Admin\MenuController@detail');
			Route::post('/edit_act', 'Admin\Admin\MenuController@edit_act');
			Route::get('/delete/{id_role}', 'Admin\Admin\MenuController@delete');
			Route::post('/delete_act', 'Admin\Admin\MenuController@delete_act');
		});
		
		//role permissions
		Route::group(["prefix"=>"role_menu"], function(){
			Route::post('/detail/', 'Admin\Admin\RoleController@role_menu');
			Route::post('/detail/2', 'Admin\Admin\RoleController@detail2');
		});

	});
});
