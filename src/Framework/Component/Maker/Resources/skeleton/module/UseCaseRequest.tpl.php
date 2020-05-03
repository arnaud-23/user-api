<?= "<?php\n" ?>

namespace App\BusinessRules\<?= $module ?>\Requestors;

use App\BusinessRules\UseCaseRequest;

interface <?= $crud_type ?><?= $entity_name ?>Request extends UseCaseRequest
{

}
