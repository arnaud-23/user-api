<?php

namespace App\BusinessRules\User\UseCases\DTO\Request;

use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\Requestors\CreateUserRequestBuilder;

class CreateUserRequestBuilderImpl implements CreateUserRequestBuilder
{
    /**
     * @var CreateUserRequestDTO
     */
    private $request;

    public function build(): CreateUserRequest
    {
        return $this->request;
    }

    public function create(string $email): CreateUserRequestBuilder
    {
        $this->request = new CreateUserRequestDTO($email);

        return $this;
    }

    public function withFirstName(string $firstName): CreateUserRequestBuilder
    {
        $this->request->firstName = $firstName;

        return $this;
    }

    public function withLastName(string $lastName): CreateUserRequestBuilder
    {
        $this->request->lastName = $lastName;

        return $this;
    }

    public function withPassword(string $password): CreateUserRequestBuilder
    {
        $this->request->password = $password;

        return $this;
    }
}
