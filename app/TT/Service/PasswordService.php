<?php namespace TT\Service;

use DB;
use Log;
use Event;
use Sentry;
use Exception;

class PasswordService {
    public function changePassword(array $input) {
        $newPassword = $input['password'];

        $user = Sentry::getUser();

        $resetCode = $user->getResetPasswordCode();

        if( $user->checkResetPasswordCode($resetCode) ) {
            if( $user->attemptResetPassword($resetCode,$newPassword) ) {
                    return true;
                }
        } 
        
        return false;      
    }

    public function resetPassword(array $input) {
        try {
            DB::beginTransaction();

            $email = $input['email'];
            
            $user = Sentry::findUserByLogin($email);

            $resetCode = $user->getResetPasswordCode();

            if($user->checkResetPasswordCode($resetCode))
            {
                $newPassword = str_random(16);

                if( $user->attemptResetPassword($resetCode,$newPassword) )
                {
                    Event::fire('user.resetpwd',[$user,$newPassword]);
                    DB::commit();
                    
                    return true;
                }

                return false;

            }

            return false;
        }

        catch(Exception $ex) {   
            Log::error($ex);
            DB::rollback();
            return false;        
        }
    }

}

?>
