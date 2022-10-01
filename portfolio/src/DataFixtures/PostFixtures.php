<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public const POST = [
        'title' => 'Titre du post',
        'slug' => 'titre-du-post',
        'description' => 'La description du tuto est la suivante, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
        vel pretium lectus quam id. Ultricies tristique',
        'content' => 'tutu toto tuto Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
        vel pretium lectus quam id. Ultricies tristique nulla aliquet enim tortor at auctor urna. Id aliquet lectus proin nibh nisl condimentum id.
        Ut tellus elementum sagittis vitae et leo duis ut diam. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Fames ac turpis egestas sed tempus.
        Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Elementum curabitur vitae nunc sed. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.
        Non arcu risus quis varius quam quisque id diam. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. 
        Amet mauris commodo quis imperdiet massa. Netus et malesuada fames ac turpis. Id semper risus in hendrerit gravida rutrum quisque. 
        Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Amet nulla facilisi morbi tempus iaculis urna id.
        Tellus cras adipiscing enim eu turpis. Feugiat vivamus at augue eget arcu. Ut morbi tincidunt augue interdum velit euismod in pellentesque. Massa ultricies mi quis hendrerit dolor magna.
        Ultricies mi eget mauris pharetra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique.',
    ];

    public function getDependencies(): array
    {
        return [TagFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; ++$i) {
            $post = new Post();
            $post->setTitle(title: self::POST['title']." $i");
            $post->setSlug(slug: self::POST['slug']."-$i");
            $post->setDescription(description: "Description $i ".self::POST['description']);
            $post->setContent(content: self::POST['content']);
            $post->setPublishedAt($faker->dateTimeBetween('-6 months'));
            $tags = array_filter([$manager->find(className: Tag::class, id: rand(1, 5)), $manager->find(className: Tag::class, id: rand(1, 5)), $manager->find(className: Tag::class, id: rand(1, 5))]);
            $post->addTag(...$tags);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
