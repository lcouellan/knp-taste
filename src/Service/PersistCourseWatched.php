<?php


namespace App\Service;


use App\Entity\WatchedCourses;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class PersistCourseWatched
 * @package App\Service
 */
class PersistCourseWatched
{

    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Persist the watched course
     *
     * @param WatchedCourses $watchedCourse
     */
    public function persist(WatchedCourses $watchedCourse): void
    {
        $this->manager->persist($watchedCourse);
        $this->manager->flush();
    }

}