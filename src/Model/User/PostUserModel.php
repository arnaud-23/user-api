<?php

namespace App\Model\User;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ DoctrineAssert\UniqueEntity("email", entityClass="App\Entity\User\UserImpl")
 */
class PostUserModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
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
     * @Assert\Regex(pattern= "/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,}$/",)
     */
    public $password;
}
