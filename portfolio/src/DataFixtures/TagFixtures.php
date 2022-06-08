<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public const TAG = [
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
        foreach (self::TAG as $data) {
            $tag = new Tag();
            $tag->setColor($data['color']);
            $tag->setName($data['name']);
            $tag->setSlug($data['slug']);

            $manager->persist($tag);
        }

        $manager->flush();
    }
}
