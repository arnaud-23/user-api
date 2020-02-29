<?php

namespace App\Tests\BusinessRules\User\UseCases;

use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\UseCases\DTO\Request\GetUserRequestBuilderImpl;
use App\BusinessRules\User\UseCases\DTO\Request\GetUserRequestDTO;
use App\BusinessRules\User\UseCases\GetUser;
use App\Tests\Doubles\BusinessRules\User\Entities\UserStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

final class GetUserTest extends TestCase
{
    private GetUser $useCase;

    private GetUserRequestDTO $request;

    /**
     * @test
     */
    public function userNotFoundThrowException(): void
    {
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage("User does not exist with this email: 'email@domaine.ext'");

        $this->request->userId = -1;
        $this->useCase->execute($this->request);
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();

        $this->useCase = new GetUser();
    }

    protected function buildRequest(): GetUserRequest
    {
        return (new GetUserRequestBuilderImpl())
            ->create()
            ->withUserId(UserStub::ID)
            ->build();
    }
}
