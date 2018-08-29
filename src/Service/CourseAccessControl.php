<?php


namespace App\Service;


use App\Entity\User;
use App\Entity\WatchedCourses;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class CourseAccessControl
{
    private $authorizationChecker;

    private $registry;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker, RegistryInterface $registry)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->registry = $registry;
    }

    /**
     * Check if a user is able to watch the next course
     *
     * @param User $user
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isAbleToWatch(User $user): bool
    {

        // Check if the user is logged
        if(!($user instanceof User)) {
            return false;
        }

        // Check if the user in an admin
        if($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            return true;
        }

        // Get the number of courses watched by the user
        $numberOfCoursesWatched = $this
            ->registry
            ->getRepository(WatchedCourses::class)
            ->getNumberOfCoursesWatchedByUser($user)
        ;

        // Compute the date where the user will be able to watch an other course
        $daysToWait = getenv('WAITING_TIME');
        $lastCourseWatched = $this->registry
            ->getRepository(WatchedCourses::class)
            ->findOneBy([
                'user' => $user,
            ],[
                'watchedAt' => 'DESC'
            ])
        ;

        // If the user never saw a single course
        if(!($lastCourseWatched instanceof WatchedCourses)) {
            return true;
        }

        /** @var \DateTime $waitingDate */
        $waitingDate = $lastCourseWatched->getWatchedAt();
        try {
            $waitingDate->add(new \DateInterval('P'.$daysToWait.'D'));
        }
        catch (\Exception $exception){};

        // Check if the user has watched less than 10 courses of he has waited enough time
        if($numberOfCoursesWatched < 10 || $waitingDate < new \DateTime()) {
            return true;
        }
        return false;

    }
}