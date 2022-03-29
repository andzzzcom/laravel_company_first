<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCProjectsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_projects_categories', function (Blueprint $table) {
            $table->bigIncrements("id_category");
			$table->string("name");
			$table->string("thumbnail");
			$table->integer("status_active");
			$table->unsignedBigInteger("creator");
			$table->unsignedBigInteger("last_updater");
			$table->dateTime("created_date")->useCurrent();
			$table->dateTime("last_updated")->default(\DB::raw("CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"));
            $table->timestamps();
			
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
        Schema::dropIfExists('c_projects_categories');
    }
}
