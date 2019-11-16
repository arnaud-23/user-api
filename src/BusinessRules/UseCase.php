<?php

namespace App\BusinessRules;

interface UseCase
{
    /**
     * @return UseCaseResponse
     */
    public function execute(UseCaseRequest $useCaseRequest);
}