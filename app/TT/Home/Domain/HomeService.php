<?php namespace TT\Home\Domain;

use Sentry;

use TT\Support\AbstractService;


class HomeService extends AbstractService{
    public function home() {
        try {
            $payload = $this->success();

            $output = $payload->getOutput();

            if( Sentry::check() ) {
                $output['user'] = Sentry::getUser();
            }

			$output['data'] = $this->getData();
			$payload->setOutput($output);
            
            return $payload;
        }

        catch(Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getData() {
        return [
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parent' => ['val'=>$this->getMsg('constants.parent')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')]		
];
    }
}
