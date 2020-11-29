<?php

namespace App\Model\User;

use App\Framework\Component\Validator\Constraints as MyAssert;
use Symfony\Component\Validator\Constraints as Assert;

class PostUserModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     * @MyAssert\AvailableEmail()
     */
    public $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $firstName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $lastName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(pattern= "/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,}$/", message="This password is too weak.")
     */
    public $password;
}
