<?php


namespace App\Service;


use App\Entity\WatchedCourses;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class PersistCourseWatched
 * @package App\Service
 */
class PersistCourseWatched
{

    private $registry;

    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Persist the watched course
     *
     * @param WatchedCourses $watchedCourse
     */
    public function persist(WatchedCourses $watchedCourse): void
    {
        $manager = $this->registry->getManager();
        $manager->persist($watchedCourse);
        $manager->flush();
    }

}