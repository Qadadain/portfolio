<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Ulid;

class UserFixtures extends Fixture
{
        public const ADMIN = [
        'email' => 'quentin.adadain@gmail.com',
        'roles' => 'ROLE_ADMIN',
        'password' => 'AdminDev33'
    ];

        public function load(ObjectManager $manager): void
    {
        $user = new User(
            identifier: new Ulid(),
            email: self::ADMIN['email'],
            roles: self::ADMIN['roles'],
            password: self::ADMIN['password'],
        );

        $manager->persist($user);
        $manager->flush();
    }
}
