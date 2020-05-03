<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\UseCases;

use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\<?= $module ?>\Entities\<?= $entity_name ?>;
use App\BusinessRules\<?= $module ?>\Entities\<?= $entity_name ?>Factory;
use App\BusinessRules\<?= $module ?>\Gateways\<?= $entity_name ?>Gateway;
use App\BusinessRules\<?= $module ?>\Requestors\<?= $crud_type ?><?= $entity_name ?>Request;
use App\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>Response;
use App\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>ResponseAssembler;

class <?= $crud_type ?><?= $entity_name ?> implements UseCase
{
    private <?= $entity_name ?>Factory $<?= lcfirst($entity_name) ?>Factory;

    private <?= $entity_name ?>Gateway $<?= lcfirst($entity_name) ?>Gateway;

    private <?= $entity_name ?>ResponseAssembler $<?= lcfirst($entity_name) ?>ResponseAssembler;

    public function __construct(
        <?= $entity_name ?>Factory $<?= lcfirst($entity_name) ?>Factory,
        <?= $entity_name ?>Gateway $<?= lcfirst($entity_name) ?>Gateway,
        <?= $entity_name ?>ResponseAssembler $<?= lcfirst($entity_name) ?>ResponseAssembler
    ) {
        $this-><?= lcfirst($entity_name) ?>Factory = $<?= lcfirst($entity_name) ?>Factory;
        $this-><?= lcfirst($entity_name) ?>Gateway = $<?= lcfirst($entity_name) ?>Gateway;
        $this-><?= lcfirst($entity_name) ?>ResponseAssembler = $<?= lcfirst($entity_name) ?>ResponseAssembler;
    }

    /**
     * @param <?= $crud_type ?><?= $entity_name ?>Request $useCaseRequest
     */
    public function execute(UseCaseRequest $useCaseRequest): <?= $entity_name ?>Response
    {
<?php if ('Create' === $crud_type): ?>
        $<?= lcfirst($entity_name) ?> = $this->build<?= $entity_name ?>($useCaseRequest);

        $this->save($<?= lcfirst($entity_name) ?>);
<?php endif; ?>

        return $this-><?= lcfirst($entity_name) ?>ResponseAssembler->create($<?= lcfirst($entity_name) ?>);
    }

    private function build<?= $entity_name ?>(<?= $crud_type ?><?= $entity_name ?>Request $useCaseRequest): <?= $entity_name ?>
    {
        $user = $this-><?= lcfirst($entity_name) ?>Factory->create();

        return $<?= lcfirst($entity_name) ?>;
    }

    private function save(<?= $entity_name ?> $<?= lcfirst($entity_name) ?>): void
    {
<?php if ('Create' === $crud_type): ?>
        $this->userGateway->insert($<?= lcfirst($entity_name) ?>);
<?php endif; ?>
    }
}
