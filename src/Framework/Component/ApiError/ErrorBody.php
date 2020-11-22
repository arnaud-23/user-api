<?php

namespace App\Framework\Component\ApiError;

use JsonSerializable;

final class ErrorBody implements JsonSerializable
{
    private ?string $code;

    private ?string $field;

    private ?string $message;

    private ?string $value;

    public function __construct(string $code = null, string $field = null, string $message = null, string $value = null)
    {
        $this->code = $code;
        $this->field = $field;
        $this->message = $message;
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        $data = [];
        null === $this->code ?: $data['code'] = $this->code;
        null === $this->field ?: $data['field'] = $this->field;
        $data['message'] = $this->message;
        null === $this->value ?: $data['value'] = $this->value;

        return !$this->isEmpty() ? $data : null;
    }

    public function isEmpty(): bool
    {
        return $this->code === null && $this->field === null && $this->message === null;
    }
}
