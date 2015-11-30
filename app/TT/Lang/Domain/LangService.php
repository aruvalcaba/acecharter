<?php namespace TT\Lang\Domain;

use Session;

use FormList;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

class LangService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory) {
        $this->payload_factory = $payload_factory;
    }

    public function isRegisteredLang($lang) {
        
        $payload = $this->payload_factory->newInstance();
        $langs = FormList::langs();

        if( in_array($lang,$langs) ) {
            $payload->setOutput([]);
            $payload->setStatus(PayloadStatus::FOUND);

            Session::put('lang',$lang);
        }

        else {
            $payload->setOutput([]);
            $payload->setStatus(PayloadStatus::NOT_FOUND);
        }

        return $payload;
    }
}
