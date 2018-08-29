<?php

namespace App\Security\Voter;

use App\Entity\Course;
use App\Entity\User;
use App\Entity\WatchedCourses;
use App\Repository\WatchedCoursesRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class HasReachedCoursesViewLimitVoter extends Voter
{
    const VIEW = 'view';

    private $repository;

    private $daysToWait;

    private $maximumCourses;

    public function __construct(WatchedCoursesRepository $repository, int $daysToWait, int $maximumCourses)
    {
        $this->repository = $repository;
        $this->daysToWait = $daysToWait;
        $this->maximumCourses = $maximumCourses;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW])) {
            return false;
        }
        if (!$subject instanceof Course) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {

        /** @var User $user */
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        $coursesWatched = $this->repository->getCoursesWatchedByUserUntil($user, new \DateTime("$this->daysToWait day ago"));

        if(count($coursesWatched) >= $this->maximumCourses) {
            return false;
        }

        return true;
    }
}