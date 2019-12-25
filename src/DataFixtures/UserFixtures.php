<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;
use DateTime;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct( UserPasswordEncoderInterface $passwordEncoder )
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for( $i = 0; $i < 10; $i++ )
        {
            $user = new User();
            $user->setUserNom( $faker->lastName );
            $user->setUserPrenom( $faker->firstName );
            $user->setUserSexe('f');
            $user->setUserEmail( $faker->email );
            $user->setUserPassword( $this->passwordEncoder->encodePassword( $user, '123456') );
            $user->setUserCreatedAt( new DateTime('now' ) );
            $manager->persist( $user );
        }

        $admins = [ 'maxime', 'axel' ];

        for( $j = 0; $j < count( $admins ); $j++ )
        {
            $user = new User();
            $user->setUserNom( $faker->lastName );
            $user->setUserPrenom( $admins[$j] );
            $user->setUserSexe('h');
            $user->setUserEmail( $admins[$j] . '@email.com' );
            $user->setUserPassword( $this->passwordEncoder->encodePassword( $user, '123456') );
            $user->setUserCreatedAt( new DateTime('now' ) );
            $user->setRoles(['ROLE_ADMIN']);
            $manager->persist( $user );
        }

        $manager->flush();
    }
}
