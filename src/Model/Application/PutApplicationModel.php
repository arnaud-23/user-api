<?php

namespace App\Model\Application;

use Symfony\Component\Validator\Constraints as Assert;

class PutApplicationModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type(string)
     */
    public $name;
}
