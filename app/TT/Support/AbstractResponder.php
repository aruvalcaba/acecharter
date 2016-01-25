<?php namespace TT\Support;

use Redirect;

use Response;

use Aura\View\View;

use Aura\Payload\Payload;

use Aura\Payload_Interface\PayloadStatus;

use Aura\Payload_Interface\PayloadInterface;

abstract class AbstractResponder {
    protected $payload;

    protected $payload_method = array();

    protected $views_registry = array();

    protected $view;

    public function __construct(View $view) {
        $this->view = $view;
        $this->init();
    }

    protected function init() {
        if ( ! isset( $this->payload_method[PayloadStatus::ERROR] ) ) {
            $this->payload_method[PayloadStatus::ERROR] = 'error';
        }
    }

    public function __invoke() {
        $status = $this->payload->getStatus();
        $method = isset($this->payload_method[$status])
                ? $this->payload_method[$status]
                : 'notRecognized';
        
        return $this->$method();
    }

    public function setPayload(PayloadInterface $payload) {
        $this->payload = $payload;
    }

    protected function notRecognized() {
        $domain_status = $this->payload->getStatus();
        return Response::make("<html><head><title>Unknown domain payload</title></head><body>Unknown payload status {$domain_status}</body></html>",500);
    }

    protected function renderView($view,$statusCode = 200) {
        $this->view->setView($view);
        $this->view->addData($this->payload->getOutput());

        return Response::make($this->view->__invoke(),$statusCode);
    }
    
    protected function notFound() {
        return Response::make("<html><head><title>404 Not found</title></head><body>404 Not found</body></html>",404)->header('Content-type','text/html');
    }

    protected function error() {
        return Response::make("<html><head><title>Oops something went wrong</title></head><body>Oops something went wrong</body></html>",500)->header('Content-type','text/html');
    }
}
