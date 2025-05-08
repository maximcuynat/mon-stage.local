<?php
// src/Exceptions/ValidationException.php
namespace App\Exceptions;

class ValidationException extends \Exception
{
    private array $errors;

    public function __construct(string $message = "Validation error", array $errors = [], int $code = 422, \Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
