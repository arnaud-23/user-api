<?php

declare(strict_types=1);

namespace App\ViewModels;

use PHPUnit\Framework\TestCase;

final class ViewModelAssemblerTest extends TestCase
{
    /** @test */
    public function assemble(): void
    {
        $viewModel = ViewModelAssembler::create(ViewModelStub::class, new \stdClass());

        self::assertInstanceOf(ViewModelStub::class, $viewModel);
    }

    /** @test */
    public function assembleCollection(): void
    {
        $collection = ViewModelAssembler::createCollection(ViewModelStub::class, [new \stdClass()]);

        $items = $collection->getItems();
        self::assertCount(1, $items);
        self::assertInstanceOf(ViewModelStub::class, reset($items));
    }
}

final class ViewModelStub
{
}
