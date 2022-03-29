<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_settings', function (Blueprint $table) {
            $table->bigIncrements("id_setting");
            $table->string("title_web");
            $table->text("subtitle_web");
            $table->string("favicon_web");
            $table->string("logo_web");
            $table->text("url_facebook");
            $table->text("url_twitter");
            $table->text("url_youtube");
            $table->text("url_instagram");
            $table->text("address");
            $table->string("phone");
            $table->string("email");
            $table->longtext("meta_title");
            $table->longtext("meta_keywords");
            $table->longtext("meta_description");
			$table->integer("status_active");
			$table->unsignedBigInteger("creator")->nullable();
            $table->unsignedBigInteger("last_updater")->nullable();
            $table->dateTime("created_date")->useCurrent();
            $table->dateTime("last_updated_date")
				->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
							
			$table->foreign("creator")->references("id_admin")->on("c_admins");
			$table->foreign("last_updater")->references("id_admin")->on("c_admins");
        });
		
		DB::table("c_settings")->insert(
			array(
				"title_Web"=>"Company First",
				"subtitle_web"=>"HR System",
				"favicon_web"=>"company_first.png",
				"logo_web"=>"company_first.png",
				"url_facebook"=>"http://facebook.com/company_first",
				"url_twitter"=>"http://twitter.com/company_first",
				"url_youtube"=>"http://youtube.com/company_first",
				"url_instagram"=>"http://instagram.com/company_first",
				"address"=>"Jakarta",
				"phone"=>"551234567",
				"email"=>"company_first@gmail.com",
				"meta_title"=>"meta title",
				"meta_keywords"=>"meta keywords",
				"meta_description"=>"meta description",
				"status_active"=>1,
				"creator"=>1,
				"last_updater"=>1,
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
        Schema::dropIfExists('c_settings');
    }
}
