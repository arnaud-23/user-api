<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\UseCases\DTO\Request;

use App\BusinessRules\<?= $module ?>\Requestors\<?= $crud_type ?><?= $entity_name ?>Request;
use App\BusinessRules\<?= $module ?>\Requestors\<?= $crud_type ?><?= $entity_name ?>RequestBuilder;

class <?= $crud_type ?><?= $entity_name ?>RequestDTO implements <?= $crud_type ?><?= $entity_name ?>Request, <?= $crud_type ?><?= $entity_name ?>RequestBuilder
{
    private <?= $crud_type ?><?= $entity_name ?>Request $request;

    public static function build(): <?= $crud_type ?><?= $entity_name ?>Request
    {
        return $this->request;
    }

    public static function create(): <?= $crud_type ?><?= $entity_name ?>RequestBuilder
    {
        $this->request = new self();

        return $this;
    }
}
