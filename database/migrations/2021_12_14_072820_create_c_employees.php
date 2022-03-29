<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_employees', function (Blueprint $table) {
			$table->bigIncrements("id_employee");
			$table->unsignedBigInteger("id_designation");
			$table->string("name");
			$table->string("email");
			$table->date("born_date");
			$table->string("photo");
			$table->string("gender");
			$table->string("phone");
			$table->string("address");
			$table->string("salary");
			$table->integer("status_active");
			$table->unsignedBigInteger("creator");
			$table->unsignedBigInteger("last_updater");
			$table->dateTime("created_date")->useCurrent();
			$table->dateTime("last_updated")->default(\DB::raw("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"));
            $table->timestamps();
			
			$table->foreign("id_designation")->references("id_designation")->on("c_designations");
							
			$table->foreign("creator")->references("id_admin")->on("c_admins");
			$table->foreign("last_updater")->references("id_admin")->on("c_admins");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_employees');
    }
}
