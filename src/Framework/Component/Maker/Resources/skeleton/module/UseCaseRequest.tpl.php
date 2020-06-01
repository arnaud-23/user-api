<?= "<?php\n" ?>

namespace App\BusinessRules\<?= $module ?>\Requestors;

use App\BusinessRules\UseCaseRequest;

final class <?= $crud_type ?><?= $entity_name ?>Request implements UseCaseRequest
{
    public static function create(): <?= $crud_type ?><?= $entity_name ?>Request
    {
        return new self();
    }
}
