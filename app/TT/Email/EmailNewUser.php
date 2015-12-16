<?php namespace TT\Email;

use Mail;
use TT\Models\User;

class EmailNewUser {
    private $layout = 'emails.welcome';
    private $from = 'notify@acecharter.org';
    private $subject = 'Welcome to ACE Charter Schools!';

    public function send(User $user, $password) {
        $data['user'] = $user;
        $data['password'] = $password;

        Mail::send($this->layout, $data, function($message) use ($data)
        {
            $message->from($this->from);
            $message->to($data['user']->email)->subject($this->subject);
        });
    }
}
