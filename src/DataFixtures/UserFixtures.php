<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/users.yml');

        /** @var User $user */
        foreach ($objectSet->getObjects() as $user) {
            $manager->persist($user);
        }
        $manager->flush();
    }
}
