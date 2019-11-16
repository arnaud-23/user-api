<?php

namespace App\Entity\User;

use App\BusinessRules\User\Entities\User;
use Carbon\CarbonImmutable;
use Ramsey\Uuid\Uuid;

class UserImpl extends User
{
    public function __construct(string $email)
    {
        parent::__construct($email);
        $this->createdAt = new CarbonImmutable();
        $this->uuid = Uuid::uuid4()->toString();
    }
}