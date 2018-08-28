<?php

namespace App\Entity;

/**
 * WatchedCourses
 */
class WatchedCourses
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $watchedAt;

    /**
     * @var \App\Entity\Course
     */
    private $course;

    /**
     * @var \App\Entity\User
     */
    private $user;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set watchedAt.
     *
     * @param \DateTime $watchedAt
     *
     * @return void
     */
    public function setWatchedAt(\DateTime $watchedAt) : void
    {
        $this->watchedAt = $watchedAt;
    }

    /**
     * Get watchedAt.
     *
     * @return \DateTime
     */
    public function getWatchedAt() : \DateTime
    {
        return $this->watchedAt;
    }

    /**
     * Set course.
     *
     * @param \App\Entity\Course|null $course
     *
     */
    public function setCourse(\App\Entity\Course $course = null) : void
    {
        $this->course = $course;
    }

    /**
     * Get course.
     *
     * @return Course|null
     */
    public function getCourse() : ?Course
    {
        return $this->course;
    }

    /**
     * Set user.
     *
     * @param User $user
     */
    public function setUser(User $user = null) : void
    {
        $this->user = $user;
    }

    /**
     * Get user.
     *
     * @return User|null
     */
    public function getUser() : ?User
    {
        return $this->user;
    }
}
