<?php

declare(strict_types=1);

namespace App\Entity\User;

use App\BusinessRules\User\Entities\User;
use Ramsey\Uuid\Uuid;

final class UserImpl extends User
{
    public function __construct(string $email)
    {
        parent::__construct($email);
        $this->uuid = Uuid::uuid4()->toString();
    }
}
