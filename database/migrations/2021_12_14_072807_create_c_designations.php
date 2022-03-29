<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCDesignations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_designations', function (Blueprint $table) {
			$table->bigIncrements("id_designation");
			$table->unsignedBigInteger("id_department");
			$table->string("name");
			$table->integer("status_active");
			$table->unsignedBigInteger("creator");
			$table->unsignedBigInteger("last_updater");
			$table->dateTime("created_date")->useCurrent();
			$table->dateTime("last_updated")->default(\DB::raw("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"));
            $table->timestamps();
			
			$table->foreign("id_department")->references("id_department")->on("c_departments");
							
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
        Schema::dropIfExists('c_designations');
    }
}
