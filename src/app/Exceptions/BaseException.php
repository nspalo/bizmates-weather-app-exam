<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class BaseException extends Exception
{
    private ?array $errors;

    public function __construct($message = '', $code = 0, ?Throwable $previous = null, ?array $errors = null)
    {
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
