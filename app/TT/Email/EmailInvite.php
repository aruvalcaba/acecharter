<?php namespace TT\Email;

use Mail;

class EmailInvite {
    private $layout = 'emails.invite';
    private $from = 'notify@acecharter.org';
    private $subject = 'ACE Charter Schools Invitation';
    //private $to = 'hg2355@columbia.edu';

    public function send($email) {
        $data['email'] = $email;

        Mail::send($this->layout, $data, function($message) use ($data)
        {
            $message->from($this->from);
            $message->to($this->to)->subject($this->subject);
        });
    }
}
