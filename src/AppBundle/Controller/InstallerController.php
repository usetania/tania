<?php
namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class InstallerController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $connection = $em->getConnection();
	
        if($connection->isConnected()) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('installer/index.html.twig', array(
            'classActive' => $_route
        ));	
    }

    public function createAction(EntityManagerInterface $em, Request $request, KernelInterface $kernel)
    {
        $dbName = $request->request->get('db-name');
        $dbHost = $request->request->get('db-host');
        $dbPort = $request->request->get('db-port');
        $dbUsername = $request->request->get('db-username');
        $dbPassword = $request->request->get('db-password');
        $mailerHost = $request->request->get('mailer-host');
        $mailerUser = $request->request->get('mailer-username');
        $mailerPass = $request->request->get('mailer-password');
        $mailerAddress = $request->request->get('mailer-address');
        $mailerSender = $request->request->get('mailer-sender');

        // write .env file
        $content = "";
        $content .= "SYMFONY_LOCALE=en\n";
        $content .= "SYMFONY_SECRET=".substr(str_shuffle(MD5(microtime())), 0, 12)."\n";
        $content .= "SYMFONY_ENV=dev\n";
        $content .= "SYMFONY_DB_HOST=".$dbHost."\n";
        $content .= "SYMFONY_DB_PORT=".$dbPort."\n";
        $content .= "SYMFONY_DB_NAME=".$dbName."\n";
        $content .= "SYMFONY_DB_USERNAME=".$dbUsername."\n";
        $content .= "SYMFONY_DB_PASSWORD=".$dbPassword."\n";
        $content .= "SYMFONY_MAILER_TRANSPORT=smtp\n";
        $content .= !empty($mailerHost) ? "SYMFONY_MAILER_HOST=".$mailerHost."\n" : "SYMFONY_MAILER_HOST=127.0.0.1\n";
        $content .= !empty($mailerUser) ? "SYMFONY_MAILER_USERNAME=".$mailerUsername."\n" : "SYMFONY_MAILER_USERNAME=admin\n";
        $content .= !empty($mailerPass) ? "SYMFONY_MAILER_PASSWORD=".$mailerPass."\n" : "SYMFONY_MAILER_PASSWORD=admin\n";
        $content .= !empty($mailerAddress) ? "SYMFONY_MAILER_FROM_ADDRESS=".$mailerAddress."\n" : "SYMFONY_MAILER_HOST=youremail@yourdomain.com\n";
        $content .= !empty($mailerSender) ? "SYMFONY_MAILER_SENDER_NAME=".$mailerSender."\n" : "SYMFONY_MAILER_SENDER_NAME=yourname\n";

        file_put_contents('../.env', $content);
        
        // Execute doctrine create database and migration
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $application->setCatchExceptions(true);

        $options = array('command' => 'doctrine:cache:clear-metadata');
        $application->run(new ArrayInput($options));

        $options = array('command' => 'doctrine:cache:clear-query');
        $application->run(new ArrayInput($options));

        $options = array('command' => 'doctrine:cache:clear-result');
        $application->run(new ArrayInput($options));
        
        $options = array('command' => 'doctrine:database:create');
        $application->run(new ArrayInput($options));

        $options = array('command' => 'doctrine:migrations:migrate', '--no-interaction' => true);
        $application->run(new ArrayInput($options));

        return $this->redirectToRoute('installer_success');
    }

    public function successAction(EntityManagerInterface $em, $_route)
    {
        $connection = $em->getConnection();

        if(!$connection->isConnected()) {
            return $this->redirectToRoute('installer');
        }

        return $this->render('installer/success.html.twig', array(
            'classActive' => $_route
        ));
    }
}
