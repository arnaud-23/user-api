<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Component\Serializer\SerializerInterface;

trait SerializerTrait
{
    private SerializerInterface $serializer;

    /** @required */
    final public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    private function serialize($vm): string
    {
        return $this->serializer->serialize($vm, 'json');
    }
}
