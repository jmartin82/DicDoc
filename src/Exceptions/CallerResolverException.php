<?php
namespace DicDoc\Exceptions;

class CallerResolverException extends \Exception {
    public function __construct($msg) {
        parent::__construct($msg);
    }
}