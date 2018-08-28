<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/courses.yml');

        /** @var Course $course */
        foreach ($objectSet->getObjects() as $course) {
            $manager->persist($course);
        }
        $manager->flush();
    }
}
