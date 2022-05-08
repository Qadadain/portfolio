<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Ulid;

class TechnologyFixtures extends Fixture
{
    public const TECHNOLOGY = [
        [
            'name' => 'PHP',
            'slug' => 'php',
            'color' => '#000000',
        ],
        [
            'name' => 'Symfony',
            'slug' => 'symfony',
            'color' => '#000000',
        ],
        [
            'name' => 'Javascript',
            'slug' => 'javascript',
            'color' => '#000000',
        ],
        [
            'name' => 'Docker',
            'slug' => 'docker',
            'color' => '#000000',
        ],
        [
            'name' => 'TailwindCSS',
            'slug' => 'tailwind',
            'color' => '#000000',
        ],
        [
            'name' => 'Bash',
            'slug' => 'bash',
            'color' => '#000000',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TECHNOLOGY as $data) {
            $technology = new Technology(
                identifier: new Ulid(),
                color: $data['color'],
                name: $data['name'],
                slug: $data['slug'],
            );
            $manager->persist($technology);
        }
        $manager->flush();
    }
}
