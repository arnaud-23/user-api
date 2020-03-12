<?php

namespace App\Repository\User;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\Entity\User\UserImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NoResultException;

class UserRepository extends ServiceEntityRepository implements UserGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserImpl::class);
    }

    public function findById(int $id): User
    {
        try {
            return $this->createQueryBuilder('u')
                ->where('u.id = :userId')
                ->setParameter('userId', $id)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw new UserNotFoundException();
        }
    }

    public function insert(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);
    }
}