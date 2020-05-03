<?= "<?php\n" ?>

namespace App\BusinessRules\<?= $module ?>\Entities;

interface <?= $entity_name ?>Factory<?= "\n" ?>
{
    public static function create(): <?= $entity_name ?>;
}
