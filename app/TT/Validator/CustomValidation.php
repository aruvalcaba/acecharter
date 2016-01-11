<?php namespace TT\Validator;

use Sentry;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CustomValidation extends Validator {
    public function validateGroup($field,$value,$params,$validator) {
        try {

            $group = Sentry::findGroupByName($params[0]);

            $user = Sentry::findUserByLogin($value);

            if( $user->inGroup($group) ) {
                return true;   
            }

            else {
                return false;
            }
        }

        catch(Exception $e) {
            return false;
        }

        catch(\Cartalyst\Sentry\Users\LoginRequiredException $e) {
            return false;
        }

        catch(\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return false;
        }

        catch(\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            return false;
        }

        catch(\Cartalyst\Sentry\Users\UserSuspendedException $e) {
            return false;
        }

        catch(\Cartalyst\Sentry\Groups\NameRequiredException $e) {
            return false;
        }

        catch(\Cartalyst\Sentry\Groups\GroupExistsException $e) {
            return false;
        }
    }

	public function validatePassword($field, $value, $params) {
		$currentPassword = $value;
		$user = Sentry::getUser();
		return $user->checkPassword($currentPassword);	
    }

    public function validateCsv($field,$file,$params) {
        if( ! ( $file instanceOf UploadedFile ) )
        {
            return false;
        }

        else
        {
            $extension = $file->getClientOriginalExtension();

            return strcmp($extension,'csv') === 0 ? true : false;
        } 
    }
}
