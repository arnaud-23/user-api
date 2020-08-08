<?php

declare(strict_types=1);

namespace App\BusinessRules;

interface UseCase
{
    public function execute(UseCaseRequest $useCaseRequest): UseCaseResponse;
}
