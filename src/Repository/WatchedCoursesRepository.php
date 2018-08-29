<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\WatchedCourses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

class WatchedCoursesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WatchedCourses::class);
    }

    /**
     * @param User $user
     * @return QueryBuilder $qb
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getNumberOfCoursesWatchedByUser(User $user)
    {
        $qb = $this->createQueryBuilder('wc');
        return $qb
            ->select($qb->expr()->count('wc.id'))
            ->where($qb->expr()->eq('wc.user', ':user'))
            ->setParameter('user', $user)
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult()
            ;

    }
}
