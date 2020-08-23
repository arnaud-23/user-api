<?php

declare(strict_types=1);

namespace App\Doubles;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateIntervalNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class Assert extends \PHPUnit\Framework\Assert
{
    /**
     * @param object|array $expected
     * @param object|array $actual
     */
    public static function assertObjectsEquals($expected, $actual, array $exclude = []): void
    {
        $serializer = self::getJsonSerializer();
        $context = self::buildContext($exclude);

        $json = [];
        foreach ([$expected, $actual] as $val) {
            if ($val instanceof \stdClass) {
                $val = json_decode(json_encode($val), true);
            }

            $json[] = $serializer->serialize($val, 'json', $context);
        }

        static::assertJsonStringEqualsJsonString($json[0], $json[1]);
    }

    private static function getJsonSerializer(): Serializer
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        return new Serializer(
            [
                new JsonSerializableNormalizer(),
                new DateTimeZoneNormalizer(),
                new DateTimeNormalizer(),
                new DateIntervalNormalizer(),
                new GetSetMethodNormalizer(),
                new ObjectNormalizer(
                    $classMetadataFactory,
                    new MetadataAwareNameConverter($classMetadataFactory)
                ),
            ],
            [new JsonEncoder()]
        );
    }

    /**
     * @return \Closure[]
     */
    private static function buildContext(array $exclude): array
    {
        $context = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => static function ($object) {
                return json_encode($object);
            },
        ];
        if ($exclude) {
            $context[AbstractNormalizer::IGNORED_ATTRIBUTES] = $exclude;
        }

        return $context;
    }
}
