<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('c_admins', function (Blueprint $table) {
            $table->bigIncrements("id_admin");
            $table->string("email");
            $table->string("password");
            $table->string("avatar");
            $table->string("name");
            $table->string("phone");
            $table->text("address");
            $table->text("born_place");
            $table->integer("gender");
            $table->unsignedBigInteger("role");
            $table->dateTime("expired_reset")->nullable();
            $table->text("token_reset")->nullable();
            $table->integer("status_reset")->nullable();
			$table->integer("status_active");
			$table->integer("creator")->nullable();
            $table->integer("last_updater")->nullable();
            $table->dateTime("last_login")->nullable();
            $table->dateTime("created_date")->useCurrent();
            $table->dateTime("last_updated_date")
				->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
				
			$table->foreign("role")->references("id_role")->on("c_roles");
        });
		
		DB::table("c_admins")->insert(
			array(
				array(
					"email"=>"admin@gmail.com",
					"password"=>'$2y$10$oo71oURavmzSkuovoZ7EwuuzkWZvIU9OI8QOv/S10JIXB63w0iuSi',
					"avatar"=>"admin.jpg",
					"role"=>1,
					"name"=>"admin",
					"phone"=>"5512345",
					"address"=>"alamat default",
					"born_place"=>"Jakarta",
					"gender"=>1,
					"status_active"=>1,
				)
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
        Schema::dropIfExists('c_admins');
    }
}
