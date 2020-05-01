<?php

declare(strict_types=1);

namespace App\ViewModels\User;

use App\BusinessRules\User\Responders\UserResponse;
use App\ViewModels\ViewModelHydrator;

class UserViewModel
{
    public string $email = '';

    public string $firstName = '';

    public string $lastName = '';

    public string $uuid = '';

    public static function create(UserResponse $userResponse): self
    {
        $viewModel = new self();
        ViewModelHydrator::hydrate($viewModel, $userResponse);

        return $viewModel;
    }
}
