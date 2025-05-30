<?php

namespace App\Exceptions\Database;

use App\Exceptions\Exception;

class DBConnectionException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
