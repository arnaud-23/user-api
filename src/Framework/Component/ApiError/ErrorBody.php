<?php

namespace App\Framework\Component\ApiError;

use JsonSerializable;

class ErrorBody implements JsonSerializable
{
    /**
     * @var string|null
     */
    protected $code;

    /**
     * @var string|null
     */
    protected $field;

    /**
     * @var string|null
     */
    protected $message;

    /**
     * @var string|null
     */
    protected $value;

    public function __construct(?string $code, ?string $field, ?string $message, ?string $value)
    {
        $this->code = $code;
        $this->field = $field;
        $this->message = $message;
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        $data = ['code' => $this->code];
        null !== $this->field ? $data['field'] = $this->field : null;
        $data['message'] = $this->message;
        null !== $this->value ? $data['value'] = $this->value : null;

        return !$this->isEmpty() ? $data : null;
    }

    public function isEmpty(): bool
    {
        return $this->code === null && $this->field === null && $this->message === null;
    }
}