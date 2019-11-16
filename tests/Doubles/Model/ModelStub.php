<?php

namespace App\Tests\Doubles\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ModelStub
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $field;
}