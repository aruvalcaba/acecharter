<?php namespace TT\Support;

use Aura\View\View;
use Aura\Web\Response;
use Aura\Accept\Accept;
use Aura\Payload\Payload;
use Aura\Payload_Interface\PayloadStatus;
use Aura\Payload_Interface\PayloadInterface;

abstract class AbstractResponder {
    protected $accept;
    
    protected $available = [ 'text/html'=>'','application/json'=>'.json' ];

    protected $response;

    protected $payload;

    protected $payload_method = array();

    protected $view;

    public function __construct(
        Accept $accept,
        Response $response,
        View $view
    ) {
        $this->accept = $accept;
        $this->response = $response;
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
        $this->$method();
        return \Response::make($this->response->content->get(),$this->response->status->getCode());
    }

    public function setPayload(PayloadInterface $payload) {
        $this->payload = $payload;
    }

    protected function notRecognized() {
        $domain_status = $this->payload->getStatus();
        $this->response->status->set(500);
        $this->response->content->set("Unknown domain payload status: '$domain_status'");
        return $this->response;
    }

    protected function negotiateMediaType() {
        if (! $this->available || ! $this->accept) {
            return true;
        }

        $available = array_keys($this->available);
        $media = $this->accept->negotiateMedia($available);
        if (! $media) {
            $this->response->status->set(406);
            $this->response->content->setType('text/plain');
            $this->response->content->set(implode(',', $available));
            return false;
        }

        $this->response->content->setType($media->getValue());
        return true;
    }

    protected function renderView($view) {
        $content_type = $this->response->content->getType();
        if ($content_type) {
            $view .= $this->available[$content_type];
        }

        $this->view->setView($view);
        $this->view->addData($this->payload->getOutput());
        $this->response->content->set($this->view->__invoke());
    }

    protected function notFound() {
        $this->response->status->set(404);
        $this->response->content->set("<html><head><title>404 Not found</title></head><body>404 Not found</body></html>");
    }

    protected function error() {
        $this->response->status->set(500);
        $this->response->content->set('Oops something went wrong');
    }
}
