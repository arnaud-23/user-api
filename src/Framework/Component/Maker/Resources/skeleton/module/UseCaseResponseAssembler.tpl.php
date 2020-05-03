<?= "<?php\n" ?>

namespace App\BusinessRules\<?= $module ?>\Responders;

interface <?= $entity_name ?>ResponseAssembler
{
    public function create(): <?= $entity_name ?>Response;
}
