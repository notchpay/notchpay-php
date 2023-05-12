<?php

namespace NotchPay\Exceptions;

class ApiException extends NotchPayException
{
    public $errors;
    public function __construct($message, array $errors = [])
    {
        parent::__construct($message);
        $this->errors = $errors;
    }
}