<?php
namespace Modules\Other;

use Illuminate\Mail\Mailer as Mail;

trait MailerTrait
{

    public function mailSend(Mail $mailer ,$template, $data)
    {
        $mailer->send('emails.'.$template, $data, function ($message) use ($data) {
            $message->from($data['email'], $data['name']);
            $message->to($data['to']);
            $message->subject($data['subject']);
        });

    }
}