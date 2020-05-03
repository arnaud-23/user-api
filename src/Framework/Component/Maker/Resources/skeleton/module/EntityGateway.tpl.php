<?= "<?php\n" ?>

namespace App\BusinessRules\<?= $module ?>\Gateways;

use App\BusinessRules\<?= $module ?>\Entities\<?= $entity_name ?>;

interface <?= $entity_name ?>Gateway
{
    public function insert(<?= $entity_name ?> $<?= lcfirst($entity_name) ?>): void;
}
