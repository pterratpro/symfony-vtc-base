<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user -> setEmail("test@gmail.com");
        $user -> setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
             'root'
        ));

        $manager->persist($user);
        
        $admin = new User();
        $admin -> setEmail("admin@gmail.com");
        $admin -> setRoles(['ROLE_USER','ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
             $admin,
             'admin'
        ));
        $manager->persist($admin);

        $manager->flush();
    }
}
