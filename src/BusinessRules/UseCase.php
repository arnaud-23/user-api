<?php

namespace App\BusinessRules;

interface UseCase
{
    public function execute(UseCaseRequest $useCaseRequest): UseCaseResponse;
}
