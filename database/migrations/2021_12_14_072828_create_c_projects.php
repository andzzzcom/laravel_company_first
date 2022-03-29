<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_projects', function (Blueprint $table) {
			$table->bigIncrements("id_project");
			$table->unsignedBigInteger("id_category");
			$table->string("name");
			$table->date("start_date");
			$table->integer("duration");
			$table->integer("status_active");
			$table->unsignedBigInteger("creator");
			$table->unsignedBigInteger("last_updater");
			$table->dateTime("created_date")->useCurrent();
			$table->dateTime("last_updated")->default(\DB::raw("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"));
            $table->timestamps();
			
			$table->foreign("id_category")->references("id_category")->on("c_projects_categories");
							
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
        Schema::dropIfExists('c_projects');
    }
}
