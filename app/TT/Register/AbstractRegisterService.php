<?php namespace TT\Register;

use TT\Support\AbstractService;

abstract class AbstractRegisterService extends AbstractService {
    abstract function register(array $input);
}
