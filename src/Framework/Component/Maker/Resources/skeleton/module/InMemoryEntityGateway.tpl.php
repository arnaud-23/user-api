<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\Doubles\BusinessRules\<?= $module ?>\Gateways;

use App\BusinessRules\<?= $module ?>\Entities\<?= $entity_name ?>;
use App\BusinessRules\<?= $module ?>\Gateways\<?= $entity_name ?>Gateway;
use App\Doubles\BusinessRules\EntityModifier;

final class InMemory<?= $entity_name ?>Gateway extends <?= $entity_name ?>Gateway
{
    /** @var <?= $entity_name ?>[] */
    public static array $<?= lcfirst($entity_name) ?> = [];

    public static int $id = 0;

    public function __construct(array $<?= lcfirst($entity_name) ?> = [])
    {
        self::$<?= lcfirst($entity_name) ?> = $<?= lcfirst($entity_name) ?>;
        self::$id = 0;
    }

    public function insert(<?= $entity_name ?> $<?= lcfirst($entity_name) ?>): void
    {
        EntityModifier::setId($<?= lcfirst($entity_name) ?>, self::$id);

        self::$<?= lcfirst($entity_name) ?>[] = $<?= lcfirst($entity_name) ?>;
    }
}
