<?php

declare(strict_types=1);

namespace App\Exceptions;

use PHPUnit\Framework\Exception;
use Throwable;

class RoomUnavailableException extends Exception
{
    protected $message = '';

    public function __construct(?string $message, int|string $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message ?? $this->message, $code, $previous);
    }
}
