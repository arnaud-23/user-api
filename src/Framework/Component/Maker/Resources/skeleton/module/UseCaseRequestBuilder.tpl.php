<?= "<?php\n" ?>

namespace App\BusinessRules\<?= $module ?>\Requestors;

interface <?= $crud_type ?><?= $entity_name ?>RequestBuilder
{
    public static function build(): <?= $crud_type ?><?= $entity_name ?>Request;

    public static function create(): <?= $crud_type ?><?= $entity_name ?>RequestBuilder;
}
