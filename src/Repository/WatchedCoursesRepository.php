<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\WatchedCourses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

class WatchedCoursesRepository extends ServiceEntityRepository
{
    CONST ALIAS = 'wc';

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WatchedCourses::class);
    }

    /**
     * @param User $user
     * @return QueryBuilder $qb
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private function buildCoursesWatchedByUser(User $user, QueryBuilder $qb = null): QueryBuilder
    {
        $qb = $qb ?: $this->createQueryBuilder(self::ALIAS);

        return $qb
            ->andWhere('wc.user = :user')
            ->setParameter('user', $user)
        ;
    }

    private function buildCoursesWatchedUntil(\DateTime $dateTime, QueryBuilder $qb = null): QueryBuilder
    {
        $qb = $qb ?: $this->createQueryBuilder(self::ALIAS);

        return $qb
            ->andWhere($qb->expr()->gt('wc.watchedAt', ':date'))
            ->setParameter('date', $dateTime)
        ;
    }

    public function getCoursesWatchedByUserUntil(User $user, \DateTime $dateTime)
    {
        $qb = $this->createQueryBuilder(self::ALIAS);

        $qb = $this->buildCoursesWatchedByUser($user, $qb);
        $qb = $this->buildCoursesWatchedUntil($dateTime, $qb);

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}
