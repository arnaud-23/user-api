<?php

declare(strict_types=1);

namespace App\Doubles;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\DateIntervalNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class Assert extends \PHPUnit\Framework\Assert
{
    /**
     * @param object|array $expected
     * @param object|array $actual
     * @param string|null  $message
     */
    public static function assertObjectsEquals($expected, $actual, string $message = ''): void
    {
        $serializer = self::getJsonSerializer();

        $json = [];
        foreach ([$expected, $actual] as $val) {
            $json[] = $val instanceof \stdClass ? json_encode($val) : $serializer->serialize($val, 'json');
        }

        static::assertJsonStringEqualsJsonString($json[0], $json[1], $message);
    }

    private static function getJsonSerializer(): Serializer
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        return new Serializer(
            [
                new JsonSerializableNormalizer(),
                new DateTimeZoneNormalizer(),
                new DateTimeNormalizer(),
                new DateIntervalNormalizer(),
                new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter),
            ],
            [new JsonEncoder()]
        );
    }
}
