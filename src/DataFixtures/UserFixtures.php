<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * UserFixture constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('gil.sampoux@gmail.com')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'webdev'))
            ->setActive(true)
            ->setTempSecretKey('temp');

        $manager->persist($user);
        $manager->flush();
    }
}