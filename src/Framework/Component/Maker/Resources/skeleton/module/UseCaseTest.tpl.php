<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\UseCases;

use App\BusinessRules\<?= $module ?>\Requestors\<?= $crud_type ?><?= $entity_name ?>Request;
use App\BusinessRules\<?= $module ?>\UseCases\DTO\Request\<?= $crud_type ?><?= $entity_name ?>RequestDTO;
use App\BusinessRules\<?= $module ?>\UseCases\DTO\Response\<?= $entity_name ?>ResponseAssemblerImpl;
use App\Entity\<?= $module ?>\<?= $entity_name ?>FactoryImpl;
use App\Tests\Doubles\Assert;
use App\Tests\Doubles\BusinessRules\<?= $module ?>\Entities\<?= $entity_name ?>Stub;
use App\Tests\Doubles\BusinessRules\<?= $module ?>\Gateways\InMemory<?= $entity_name ?>Gateway;
use App\Tests\Doubles\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>ResponseStub;
use PHPUnit\Framework\TestCase;

class <?= $crud_type ?><?= $entity_name ?>Test extends TestCase
{
    private <?= $crud_type ?><?= $entity_name ?>Request $request;

    private <?= $crud_type ?><?= $entity_name ?> $useCase;

    /**
     * @test
     */
    final public function <?= lcfirst($crud_type) ?><?= $entity_name ?>SaveAndReturn<?= $entity_name ?>(): void
    {
        InMemory<?= $entity_name ?>Gateway::$id = <?= $entity_name ?>Stub::ID;

        $response = $this->useCase->execute($this->request);

        Assert::assertObjectsEquals(new <?= $entity_name ?>Stub(), reset(InMemory<?= $entity_name ?>Gateway::$<?= lcfirst($entity_name) ?>));
        Assert::assertObjectsEquals(new <?= $entity_name ?>ResponseStub(), $response);
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();

        $this->useCase = new <?= $crud_type ?><?= $entity_name ?>(
            new <?= $entity_name ?>FactoryImpl(),
            new InMemory<?= $entity_name ?>Gateway(),
            new <?= $entity_name ?>ResponseAssemblerImpl()
        );
    }

    private function buildRequest(): <?= $crud_type ?><?= $entity_name ?>Request
    {
        <?= $crud_type ?><?= $entity_name ?>RequestDTO::create();

        return <?= $crud_type ?><?= $entity_name ?>RequestDTO::build();
    }
}
