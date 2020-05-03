<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\UseCases\DTO\Response;

use App\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>Response;

class <?= $entity_name ?>ResponseDTO implements <?= $entity_name ?>Response
{

}
