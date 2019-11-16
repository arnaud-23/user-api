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

    public function __construct(string $jsonContent)
    {
        $content = json_decode($jsonContent, true);
        $this->email = $content['email'] ?? null;
        $this->firstName = $content['firstName'] ?? null;
        $this->lastName = $content['lastName'] ?? null;
    }
}