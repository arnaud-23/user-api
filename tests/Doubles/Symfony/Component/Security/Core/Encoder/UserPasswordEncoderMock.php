<?php

declare(strict_types=1);

namespace App\Tests\Doubles\Symfony\Component\Security\Core\Encoder;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserPasswordEncoderMock implements UserPasswordEncoderInterface
{
    public static ?string $encodedPassword;

    public static bool $isPasswordValid = true;

    public static bool $needsRehash = true;

    public function __construct()
    {
        self::$encodedPassword = null;
        self::$isPasswordValid = true;
        self::$needsRehash = true;
    }

    public function encodePassword(UserInterface $user, $plainPassword): string
    {
        return self::$encodedPassword;
    }

    public function isPasswordValid(UserInterface $user, $raw): bool
    {
        return self::$isPasswordValid;
    }

    public function needsRehash(UserInterface $user): bool
    {
        return self::$needsRehash;
    }
}
