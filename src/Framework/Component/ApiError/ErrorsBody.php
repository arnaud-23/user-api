<?php

namespace App\Framework\Component\ApiError;

use JsonSerializable;

class ErrorsBody implements JsonSerializable
{
    /**
     * @var ErrorBody[]
     */
    protected $errors;

    /**
     * @param ErrorBody[] $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function jsonSerialize()
    {
        $data = ['errors' => $this->errors];

        return !$this->isEmpty() ? $data : null;
    }

    public function isEmpty(): bool
    {
        foreach ($this->errors as $error) {
            if (!$error->isEmpty()) {
                return false;
            }
        }

        return true;
    }
}