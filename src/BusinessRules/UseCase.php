<?php

namespace App\BusinessRules;

interface UseCase
{
    /**
     * @param UseCaseRequest $useCaseRequest
     *
     * @return UseCaseResponse
     */
    public function execute(UseCaseRequest $useCaseRequest);
}