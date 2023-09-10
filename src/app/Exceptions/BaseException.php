<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class BaseException extends Exception
{
    /**
     * @var array|null
     */
    private ?array $errors;

    /**
     * @param $message
     * @param $code
     * @param Throwable|null $previous
     * @param array|null $errors
     */
    public function __construct($message = '', $code = 0, ?Throwable $previous = null, ?array $errors = null)
    {
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
