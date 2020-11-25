<?php

declare(strict_types=1);

namespace App\Framework\HttpFoundation;

final class RequestFormat
{
    public const JSON = 'json';

    public const FORM = 'form';

    private function __construct()
    {
    }
}
