<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\Entities;

interface <?= $entity_name ?>Factory<?= "\n" ?>
{
    public static function create(): <?= $entity_name ?>;
}
