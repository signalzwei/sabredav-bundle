<?php
namespace Signalzwei\Bundle\SabreDavBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDatabaseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('dav:create-database')
            ->setDescription('Creates the database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var \PDO $pdo */
        $pdo = $this->getContainer()->get('sabredav.pdo');

        $locator = new FileLocator(__DIR__.'/../Resources/sql/');
        $principals = $locator->locate('mysql.principals.sql', null, false);
        $stmt = $pdo->exec(file_get_contents($principals[0]));

        print_r($pdo->errorInfo());
        print_r($stmt);

        $principals = $locator->locate('mysql.calendars.sql', null, false);
        $stmt = $pdo->exec(file_get_contents($principals[0]));

        print_r($pdo->errorInfo());
        print_r($stmt);
    }
}