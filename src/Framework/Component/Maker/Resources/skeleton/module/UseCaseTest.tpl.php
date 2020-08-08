<?= "<?php\n" ?>

declare(strict_types=1);

namespace App\BusinessRules\<?= $module ?>\UseCases;

use App\BusinessRules\<?= $module ?>\Requestors\<?= $crud_type ?><?= $entity_name ?>Request;
use App\BusinessRules\<?= $module ?>\Responders\<?= $entity_name ?>Response;
use App\Entity\<?= $module ?>\<?= $entity_name ?>FactoryImpl;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\<?= $module ?>\Gateways\InMemory<?= $entity_name ?>Gateway;
use PHPUnit\Framework\TestCase;

final class <?= $crud_type ?><?= $entity_name ?>Test extends TestCase
{
    private <?= $crud_type ?><?= $entity_name ?> $useCase;

    private <?= $crud_type ?><?= $entity_name ?>Request $request;

    /** @test */
    public function <?= lcfirst($crud_type) ?><?= $entity_name ?>SaveAndReturn<?= $entity_name ?>(): void
    {
        $expectedEntity = InMemoryFixtureGateway::get('<?= $entity_name ?>1');
        $expectedResponse = UseCaseResponseAssembler::create(<?= $entity_name ?>Response::class, $expectedEntity);
        InMemory<?= $entity_name ?>Gateway::$id = $expectedEntity->getId();

        $response = $this->useCase->execute(<?= $crud_type ?><?= $entity_name ?>Request::create());

        Assert::assertObjectsEquals($expectedEntity, reset(InMemory<?= $entity_name ?>Gateway::$<?= lcfirst($entity_name) ?>));
        Assert::assertObjectsEquals($expectedResponse, $response);
        $expectedResponse = UseCaseResponseAssembler::create(<?= $entity_name ?>Response::class, $expectedEntity);
        Assert::assertObjectsEquals($expectedResponse, $response);
    }

    protected function setUp(): void
    {
        $this->useCase = new <?= $crud_type ?><?= $entity_name ?>(
            new <?= $entity_name ?>FactoryImpl(),
            new InMemory<?= $entity_name ?>Gateway()
        );
    }

    protected function buildRequest(): <?= $crud_type ?><?= $entity_name ?>Request
    {
        return <?= $crud_type ?><?= $entity_name ?>Request::create();
    }
}
