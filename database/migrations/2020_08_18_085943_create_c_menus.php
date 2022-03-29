<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create("c_menus", function(Blueprint $table){
			$table->bigIncrements("id_menu");
			$table->string("name_menu");
			$table->datetime("created_date_menu")->useCurrent();
			$table->datetime("last_updated_date_menu")->default(\DB::raw("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"));
			$table->integer("status_menu");
		});
		
		DB::table("c_menus")->insert(
			array(
				array(
					"name_menu"=>"admin/department",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/designation",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/employee",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/project",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/leave",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/admin",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/role",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/menu",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/role_menu",
					"status_menu"=>1,
				),
				array(
					"name_menu"=>"admin/setting",
					"status_menu"=>1,
				),
			)
		);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_menus');
    }
}
