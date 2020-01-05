<?php

namespace App\Tests\Doubles\BusinessRules\User\Entities;

use App\BusinessRules\User\Entities\User;
use PHPUnit\Framework\Assert;

trait UserTestCase
{
    private function assertUser(User $expected, User $actual): void
    {
        Assert::assertSame($expected->getEmail(), $actual->getEmail());
        Assert::assertSame($expected->getFirstName(), $actual->getFirstName());
        Assert::assertSame($expected->getId(), $actual->getId());
        Assert::assertSame($expected->getLastName(), $actual->getLastName());
        Assert::assertSame($expected->getUuid(), $actual->getUuid());
    }
}