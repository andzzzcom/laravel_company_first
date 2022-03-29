<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

	public $data;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
		$this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$view 		= "reset";
		$subject	= "Forgot Password";
		$email 		= $this->data["email"];
		$link 		= $this->data["link"];
		
		return 
			$this
			->from("testing@gmail.com")
			->subject($subject)
			->view('Email.'.$view)
			->with("email", $email)
			->with("link", $link);
		
    }
}
