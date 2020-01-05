<?php

namespace App\Repository\Security\User;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialsNotFoundException;
use App\Entity\Security\User\UserSecurityCredentialImpl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

class UserSecurityCredentialRepository extends ServiceEntityRepository implements UserSecurityCredentialGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSecurityCredentialImpl::class);
    }

    public function findById(int $id): UserSecurityCredential
    {
        try {
            return $this->createQueryBuilder('usc')
                ->where('IDENTITY(usc) = :userId')
                ->setParameter('userId', $id)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw new UserSecurityCredentialsNotFoundException();
        }
    }

    public function findByEmail(string $email): UserSecurityCredential
    {
        try {
            return $this->createQueryBuilder('usc')
                ->join('usc.user', 'u')
                ->where('lower(u.email) = lower(:email)')
                ->setParameter('email', $email)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            throw new UserSecurityCredentialsNotFoundException();
        }
    }
}