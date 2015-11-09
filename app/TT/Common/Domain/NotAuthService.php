<?php namespace TT\Common\Domain;

use Sentry;

use TT\Support\AbstractService;

class NotAuthService extends AbstractService {
    public function notAuthorized() {
        try {
            $payload = $this->success();

            if( Sentry::check() ) {
                $output = $payload->getOutput();
                $output['user'] = Sentry::getUser();
                $payload->setOutput($output);
            }

            return $payload;
        }

        catch(Exception $e) {
            return $this->error($e->getMessage());
        } 
    }

    public function getData() {
        return [];
    }
}
