<?php

declare(strict_types=1);

namespace App\Repository\Application;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Gateways\ApplicationGateway;
use App\BusinessRules\Application\Gateways\ApplicationNotFoundException;
use App\Entity\Application\ApplicationImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

final class ApplicationRepository extends ServiceEntityRepository implements ApplicationGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationImpl::class);
    }

    public function findAllByUser(string $userUuid): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.owner', 'owner')
            ->where('owner.uuid = :userUuid')
            ->setParameter('userUuid', $userUuid)
            ->getQuery()
            ->getResult();
    }

    public function findByUuid(string $uuid): Application
    {
        try {
            return $this->createQueryBuilder('a')
                ->where('a.uuid = :uuid')
                ->setParameter('uuid', $uuid)
                ->getQuery()
                ->getResult();
        } catch (NoResultException $exception) {
            throw new ApplicationNotFoundException();
        }
    }

    public function insert(Application $application): void
    {
        $this->getEntityManager()->persist($application);
        $this->getEntityManager()->flush();
    }
}
