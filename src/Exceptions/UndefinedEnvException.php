<?php

namespace SafePHP\Exceptions;

class UndefinedEnvException extends \Exception implements SafePHPExceptionInterface
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
