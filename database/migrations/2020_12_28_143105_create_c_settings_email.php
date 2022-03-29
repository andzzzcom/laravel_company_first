<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSettingsEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_settings_email', function (Blueprint $table) {
            $table->bigIncrements("id_setting_email");
            $table->string("mail_type");
            $table->string("mail_host");
            $table->string("mail_port");
            $table->string("mail_username");
            $table->string("mail_password");
            $table->string("mail_encryption");
			$table->integer("status_active");
            $table->dateTime("created_date")->useCurrent();
            $table->dateTime("last_updated_date")
				->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
		
		DB::table("c_settings_email")->insert(
			array(
				"mail_type"=>"smtp",
				"mail_host"=>"smtp.gmail.com",
				"mail_port"=>465,
				"mail_username"=>"testingbestlist@gmail.com",
				"mail_password"=>"agfpncrexovbjbih",
				"mail_encryption"=>"ssl",
				"status_active"=>1,
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
        Schema::dropIfExists('c_settings_email');
    }
}
