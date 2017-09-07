<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
     
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        
        $email_exist = $userManager->findUserByEmail('test@test.id');
        
        // Check if the user exists to prevent Integrity constraint violation error in the insertion
        if($email_exist){
            return false;
        }

        $user = $userManager->createUser();
        $user->setUsername('testuser');
        $user->setEmail('test@test.id');
        $user->setEnabled(true);
        $user->setPlainPassword('test123');

        $userManager->updateUser($user);
    }
}