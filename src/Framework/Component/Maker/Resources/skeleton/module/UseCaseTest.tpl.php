<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\UseCases;

use App\BusinessRules\<?= $module ?>\Requestors\<?= $crud_type ?><?= $entity_name ?>Request;
use App\Entity\<?= $module ?>\<?= $entity_name ?>FactoryImpl;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\<?= $module ?>\Entities\<?= $entity_name ?>Stub;
use App\Doubles\BusinessRules\<?= $module ?>\Gateways\InMemory<?= $entity_name ?>Gateway;
use App\Doubles\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>ResponseStub;
use PHPUnit\Framework\TestCase;

final class <?= $crud_type ?><?= $entity_name ?>Test extends TestCase
{
    private <?= $crud_type ?><?= $entity_name ?> $useCase;

    /** @test */
    public function <?= lcfirst($crud_type) ?><?= $entity_name ?>SaveAndReturn<?= $entity_name ?>(): void
    {
        InMemory<?= $entity_name ?>Gateway::$id = <?= $entity_name ?>Stub::ID;

        $response = $this->useCase->execute(<?= $crud_type ?><?= $entity_name ?>Request::create());

        Assert::assertObjectsEquals(new <?= $entity_name ?>Stub(), reset(InMemory<?= $entity_name ?>Gateway::$<?= lcfirst($entity_name) ?>));
        Assert::assertObjectsEquals(new <?= $entity_name ?>ResponseStub(), $response);
    }

    protected function setUp(): void
    {
        $this->useCase = new <?= $crud_type ?><?= $entity_name ?>(
            new <?= $entity_name ?>FactoryImpl(),
            new InMemory<?= $entity_name ?>Gateway()
        );
    }
}
