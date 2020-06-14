<?php

declare(strict_types=1);

namespace App\ViewModels;

final class ViewModelAssembler
{
    public static function create(string $ViewModelClassName, $entityResponse)
    {
        $vm = new $ViewModelClassName();
        ViewModelHydrator::hydrate($vm, $entityResponse);

        return $vm;
    }
}
