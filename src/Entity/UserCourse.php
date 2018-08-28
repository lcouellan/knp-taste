<?php

namespace App\Entity;

/**
 * UserCourse
 */
class UserCourse
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set watchedAt.
     *
     * @param \DateTime $watchedAt
     *
     * @return UserCourse
     */
    public function setWatchedAt($watchedAt)
    {
        $this->watchedAt = $watchedAt;

        return $this;
    }

    /**
     * Get watchedAt.
     *
     * @return \DateTime
     */
    public function getWatchedAt()
    {
        return $this->watchedAt;
    }

    /**
     * Set course.
     *
     * @param \App\Entity\Course|null $course
     *
     * @return UserCourse
     */
    public function setCourse(\App\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course.
     *
     * @return \App\Entity\Course|null
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set user.
     *
     * @param \App\Entity\User|null $user
     *
     * @return UserCourse
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \App\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
