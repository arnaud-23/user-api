<?php

declare(strict_types=1);

namespace App\ViewModels;

final class ViewModelAssembler
{
    public static function createCollection(string $viewModelClassName, array $items): ViewModelCollection
    {
        $vms = [];
        foreach ($items as $item) {
            $vms[] = self::create($viewModelClassName, $item);
        }

        return new ViewModelCollection($vms);
    }

    public static function create(string $viewModelClassName, $item)
    {
        $vm = new $viewModelClassName();
        ViewModelHydrator::hydrate($vm, $item);

        return $vm;
    }
}
