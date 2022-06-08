<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    public const POST = [
        [
            'title' => 'Titre du post 1',
            'description' => 'La description du tuto est la suivante 1',
            'content' => 'tutu toto tuto Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
              vel pretium lectus quam id. Ultricies tristique nulla aliquet enim tortor at auctor urna. Id aliquet lectus proin nibh nisl condimentum id.
              Ut tellus elementum sagittis vitae et leo duis ut diam. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Fames ac turpis egestas sed tempus.
              Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Elementum curabitur vitae nunc sed. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.
              Non arcu risus quis varius quam quisque id diam. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. 
              Amet mauris commodo quis imperdiet massa. Netus et malesuada fames ac turpis. Id semper risus in hendrerit gravida rutrum quisque. 
              Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Amet nulla facilisi morbi tempus iaculis urna id.
              Tellus cras adipiscing enim eu turpis. Feugiat vivamus at augue eget arcu. Ut morbi tincidunt augue interdum velit euismod in pellentesque. Massa ultricies mi quis hendrerit dolor magna.
               Ultricies mi eget mauris pharetra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique.',
        ],
        [
            'title' => 'Titre du post 2',
            'description' => 'La description du post 2 est la suivante',
            'content' => 'tutu toto tuto Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
              vel pretium lectus quam id. Ultricies tristique nulla aliquet enim tortor at auctor urna. Id aliquet lectus proin nibh nisl condimentum id.
              Ut tellus elementum sagittis vitae et leo duis ut diam. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Fames ac turpis egestas sed tempus.
              Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Elementum curabitur vitae nunc sed. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.
              Non arcu risus quis varius quam quisque id diam. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. 
              Amet mauris commodo quis imperdiet massa. Netus et malesuada fames ac turpis. Id semper risus in hendrerit gravida rutrum quisque. 
              Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Amet nulla facilisi morbi tempus iaculis urna id.
              Tellus cras adipiscing enim eu turpis. Feugiat vivamus at augue eget arcu. Ut morbi tincidunt augue interdum velit euismod in pellentesque. Massa ultricies mi quis hendrerit dolor magna.
               Ultricies mi eget mauris pharetra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique.',
        ],
        [
            'title' => 'Titre du post 3',
            'description' => 'La description du post 3 est la suivante',
            'content' => 'tutu toto tuto Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
              vel pretium lectus quam id. Ultricies tristique nulla aliquet enim tortor at auctor urna. Id aliquet lectus proin nibh nisl condimentum id.
              Ut tellus elementum sagittis vitae et leo duis ut diam. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Fames ac turpis egestas sed tempus.
              Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Elementum curabitur vitae nunc sed. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.
              Non arcu risus quis varius quam quisque id diam. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. 
              Amet mauris commodo quis imperdiet massa. Netus et malesuada fames ac turpis. Id semper risus in hendrerit gravida rutrum quisque. 
              Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Amet nulla facilisi morbi tempus iaculis urna id.
              Tellus cras adipiscing enim eu turpis. Feugiat vivamus at augue eget arcu. Ut morbi tincidunt augue interdum velit euismod in pellentesque. Massa ultricies mi quis hendrerit dolor magna.
               Ultricies mi eget mauris pharetra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique.',
        ],
        [
            'title' => 'Titre du post 4',
            'description' => 'La description du post 4 est la suivante',
            'content' => 'tutu toto tuto Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
              vel pretium lectus quam id. Ultricies tristique nulla aliquet enim tortor at auctor urna. Id aliquet lectus proin nibh nisl condimentum id.
              Ut tellus elementum sagittis vitae et leo duis ut diam. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Fames ac turpis egestas sed tempus.
              Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Elementum curabitur vitae nunc sed. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.
              Non arcu risus quis varius quam quisque id diam. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. 
              Amet mauris commodo quis imperdiet massa. Netus et malesuada fames ac turpis. Id semper risus in hendrerit gravida rutrum quisque. 
              Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Amet nulla facilisi morbi tempus iaculis urna id.
              Tellus cras adipiscing enim eu turpis. Feugiat vivamus at augue eget arcu. Ut morbi tincidunt augue interdum velit euismod in pellentesque. Massa ultricies mi quis hendrerit dolor magna.
               Ultricies mi eget mauris pharetra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique.',
        ],
        [
            'title' => 'Titre est ICI du post 5',
            'description' => 'La description du tuto est la suivante',
            'content' => 'tutu toto tuto Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
              vel pretium lectus quam id. Ultricies tristique nulla aliquet enim tortor at auctor urna. Id aliquet lectus proin nibh nisl condimentum id.
              Ut tellus elementum sagittis vitae et leo duis ut diam. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Fames ac turpis egestas sed tempus.
              Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Elementum curabitur vitae nunc sed. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.
              Non arcu risus quis varius quam quisque id diam. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. 
              Amet mauris commodo quis imperdiet massa. Netus et malesuada fames ac turpis. Id semper risus in hendrerit gravida rutrum quisque. 
              Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Amet nulla facilisi morbi tempus iaculis urna id.
              Tellus cras adipiscing enim eu turpis. Feugiat vivamus at augue eget arcu. Ut morbi tincidunt augue interdum velit euismod in pellentesque. Massa ultricies mi quis hendrerit dolor magna.
               Ultricies mi eget mauris pharetra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique.',
        ],
        [
            'title' => 'Titre 5',
            'description' => 'La description du tuto est la suivante',
            'content' => 'tutu toto tuto Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl 
              vel pretium lectus quam id. Ultricies tristique nulla aliquet enim tortor at auctor urna. Id aliquet lectus proin nibh nisl condimentum id.
              Ut tellus elementum sagittis vitae et leo duis ut diam. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae purus. Fames ac turpis egestas sed tempus.
              Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Elementum curabitur vitae nunc sed. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.
              Non arcu risus quis varius quam quisque id diam. Vehicula ipsum a arcu cursus vitae congue mauris rhoncus. 
              Amet mauris commodo quis imperdiet massa. Netus et malesuada fames ac turpis. Id semper risus in hendrerit gravida rutrum quisque. 
              Faucibus interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Amet nulla facilisi morbi tempus iaculis urna id.
              Tellus cras adipiscing enim eu turpis. Feugiat vivamus at augue eget arcu. Ut morbi tincidunt augue interdum velit euismod in pellentesque. Massa ultricies mi quis hendrerit dolor magna.
               Ultricies mi eget mauris pharetra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique.',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (self::POST as $data) {
            $post = new Post();
            $post->setTitle($data['title']);
            $post->setContent($data['content']);
            $post->setDescription($data['description']);
            $post->setPublishedAt($faker->dateTime);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
