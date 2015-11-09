<?php namespace TT\Home\Domain;

use Sentry;

use TT\Support\AbstractService;

class HomeService extends AbstractService{
    public function home() {
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
