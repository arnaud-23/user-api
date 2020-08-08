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

        $this->assertInstanceOf(ViewModelStub::class, $viewModel);
    }
}

class ViewModelStub
{
}
