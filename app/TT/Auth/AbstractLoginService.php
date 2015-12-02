<?php namespace TT\Auth;

use Sentry;

use TT\Auth\AuthForm;
use TT\Auth\AuthInterface;

use Aura\Payload\Payload;

use TT\Support\AbstractService;

abstract class AbstractLoginService extends AbstractService implements AuthInterface {
    public function fetchLogin() {
        try {
                $payload = $this->success();
                $output = $payload->getOutput();

                if( ! Sentry::check() ) {
                    $output['user'] = Sentry::getUser();
                }

                $output['data'] = $this->getData();
                $payload->setOutput($output);
                return $payload;
        }

        catch(Exception $e) {
            return $this->error($e);
        }
    }

    public function login(array $credentials) {
    
    }
}

?>
