<?php

namespace SafePHP\Exceptions;

class HashFileException extends \Exception implements SafePHPExceptionInterface
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
