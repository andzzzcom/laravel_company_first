<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_logs', function (Blueprint $table) {
            $table->bigIncrements("id_log");
			$table->string("ip_address");
			$table->unsignedBigInteger("id_admin");
			$table->unsignedBigInteger("id_menu");
			$table->string("action");
            $table->dateTime("created_date")->useCurrent();
							
			$table->foreign("id_admin")->references("id_admin")->on("c_admins");
			$table->foreign("id_menu")->references("id_menu")->on("c_menus");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_logs');
    }
}
