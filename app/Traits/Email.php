<?php

namespace App\Traits;
use App\Models\SettingsEmail_m;

trait Email
{

    public static function setMailConfig()
	{
		$settings = SettingsEmail_m::where("status_active", 1)->get();
        $mailConfig = [
            'transport' => $settings[0]['mail_type'],
            'host' => $settings[0]['mail_host'],
            'port' => $settings[0]['mail_port'],
            'encryption' => $settings[0]['mail_encryption'],
            'username' => $settings[0]['mail_username'],
            'password' => $settings[0]['mail_password'],
            'timeout' => null
        ];

        //To set configuration values at runtime, pass an array to the config helper
        config(['mail.mailers.smtp' => $mailConfig]);
    }
}