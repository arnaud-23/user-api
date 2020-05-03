<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\UseCases\DTO\Response;

use App\BusinessRules\DtoFieldsHydrator;
use App\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>Response;
use App\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>ResponseAssembler;

class <?= $entity_name ?>ResponseAssemblerImpl implements <?= $entity_name ?>Assembler
{
    public static function create(<?= $entity_name ?> $<?= lcfirst($entity_name) ?>): <?= $entity_name ?>Response
    {
        $response = new self();
        DtoFieldsHydrator::hydrate($response, $<?= lcfirst($entity_name) ?>);

        return $response;
    }
}
