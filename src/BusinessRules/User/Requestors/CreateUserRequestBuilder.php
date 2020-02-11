<?php

namespace App\BusinessRules\User\Requestors;

interface CreateUserRequestBuilder
{
    public function build(): CreateUserRequest;

    public function create(string $email): CreateUserRequestBuilder;

    public function withFirstName(string $firstName): CreateUserRequestBuilder;

    public function withLastName(string $lastName): CreateUserRequestBuilder;

    public function withPassword(string $password): CreateUserRequestBuilder;
}
