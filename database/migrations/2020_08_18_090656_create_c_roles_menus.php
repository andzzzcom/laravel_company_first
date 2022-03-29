<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCRolesMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create("c_roles_menus", function(Blueprint $table){
			$table->bigIncrements("id_role_menu");
			$table->unsignedBigInteger("role_id");
			$table->unsignedBigInteger("menu_id");
			$table->datetime("created_date")->useCurrent();
			$table->datetime("last_updated_date")->default(\DB::raw("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"));
			$table->integer("status_role_menu");
			
			$table->foreign("role_id")->references("id_role")->on("c_roles");
			$table->foreign("menu_id")->references("id_menu")->on("c_menus");
		});
		
		DB::table("c_roles_menus")->insert(
			array(
				array(
					"role_id"=>1,
					"menu_id"=>1,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>2,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>3,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>4,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>5,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>6,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>7,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>8,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>9,
					"status_role_menu"=>1,
				),
				array(
					"role_id"=>1,
					"menu_id"=>10,
					"status_role_menu"=>1,
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
        Schema::dropIfExists('c_roles_menus');
    }
}
