<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\Requestors;

use App\BusinessRules\UseCaseRequest;

final class <?= $crud_type ?><?= $entity_name ?>Request extends UseCaseRequest
{
    public static function create(): <?= $crud_type ?><?= $entity_name ?>Request
    {
        return new self();
    }
}
