<?php

declare(strict_types=1);

namespace App\Repository\Application;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Gateways\ApplicationGateway;
use App\Entity\Application\ApplicationImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ApplicationRepository extends ServiceEntityRepository implements ApplicationGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationImpl::class);
    }

    public function insert(Application $application): void
    {
        $this->getEntityManager()->persist($application);
        $this->getEntityManager()->flush();
    }
}
