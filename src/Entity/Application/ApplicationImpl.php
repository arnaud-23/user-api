<?php

declare(strict_types=1);

namespace App\Entity\Application;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\User\Entities\User;
use Ramsey\Uuid\Uuid;

final class ApplicationImpl extends Application
{
    public function __construct(User $owner, string $name)
    {
        parent::__construct($owner, $name);
        $this->uuid = Uuid::uuid4()->toString();
    }
}
