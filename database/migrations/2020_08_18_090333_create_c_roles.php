<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create("c_roles", function(Blueprint $table){
			$table->bigIncrements("id_role");
			$table->string("name_role");
			$table->datetime("created_date_role")->useCurrent();
			$table->datetime("last_updated_date_role")->default(\DB::raw("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"));
			$table->integer("status_role");
			
		});
		
		DB::table("c_roles")->insert(
			array(
				array(
					"name_role"=>"admin",
					"status_role"=>1
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
        Schema::dropIfExists('c_roles');
    }
}
