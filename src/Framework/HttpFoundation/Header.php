<?php

declare(strict_types=1);

namespace App\Framework\HttpFoundation;

final class Header
{
    public const ACCEPT               = 'Accept';

    public const ACCEPT_LANGUAGE      = 'Accept-Language';

    public const AUTHORIZATION        = 'Authorization';

    public const BASIC                = 'Basic';

    public const BEARER               = 'Bearer';

    public const CONTENT_LANGUAGE     = 'Content-Language';

    public const CONTENT_RANGE        = 'Content-Range';

    public const CONTENT_TYPE         = 'Content-Type';

    public const ITEMS                = 'items';

    public const LINK                 = 'Link';

    public const LOCATION             = 'Location';

    public const RANGE                = 'Range';

    public const REGEX_ACCEPT_VERSION = '#version=[\^><~=]*([a-zA-Z0-9\.*-]+)#';

    public const VERSION              = 'version';

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }
}
