<?php

namespace BlogBundle\Pdo;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Database
{
    //TODO add Singleton to Database Class

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getConnection(): \PDO
    {
        try {
            $connection = new \PDO(
                sprintf(
                    'mysql:dbname=%s;host=%s',
                    $this->container->getParameter('database_name'),
                    $this->container->getParameter('database_host')
                ),
                $this->container->getParameter('database_user'),
                $this->container->getParameter('database_password'),
                [
                    \PDO::ATTR_PERSISTENT => true,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            );

            return $connection;
        } catch (\PDOException $e) {
            throw new \RuntimeException('DB connection error : '.$e->getMessage());
        }
    }
}
