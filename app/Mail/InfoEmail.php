<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InfoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $content;

    public function __construct( $user, $content )
    {
        $this->user = $user;
        $this->content = $content;
    }

    public function build()
    {
        return $this->from('info@timesofreading.com', 'Times Of Reading')
                    ->subject( $this->content->title )
                    ->view('emails.blog-info');
    }
}