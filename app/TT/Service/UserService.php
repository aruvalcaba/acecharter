<?php namespace TT\Service;

use Log;
use Exception;
use TT\Email\EmailInvite;

class UserService {
    public function invite(array $data) {
        $email = new EmailInvite;

        try {
            $email->send($data['email']);
            return true;
        }

        catch(Exception $ex) {
            Log::error($ex);
            return false;
        } 
    }
}
