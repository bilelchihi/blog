<?php

namespace BlogBundle\Item;


use BlogBundle\Model\Item;
use BlogBundle\Pdo\Database;

class ItemManager
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getItemById(int $id): object
    {
        $query = $this->database->getConnection();
        $query = $query->prepare("SELECT * FROM item WHERE id = :id LIMIT 1");
        $query->execute([':id' => $id]);

        if (!$query->rowCount()){
            throw new \InvalidArgumentException("No data found for this id : $id");
        }

        return $query->fetchObject(Item::class);
    }

    public function getAllItems(): array
    {
        $query = $this->database->getConnection();
        $query = $query->prepare("SELECT * FROM item");
        $query->execute();

        if (!$query->rowCount()){
            throw new \InvalidArgumentException('No data found !');
        }

        return $query->fetchAll(\PDO::FETCH_CLASS, Item::class);
    }
}
