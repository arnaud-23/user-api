<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Responders;

use App\BusinessRules\UseCaseResponse;

final class ApplicationsResponse implements UseCaseResponse
{
    /** @var ApplicationResponse[] */
    public array $applications = [];

    public function __construct(array $applications)
    {
        $this->applications = $applications;
    }

    /** @param ApplicationResponse[] $applications */
    public static function create(array $applications): self
    {
        return new self($applications);
    }

    /** @return ApplicationResponse[] */
    public function getApplications(): array
    {
        return $this->applications;
    }
}
