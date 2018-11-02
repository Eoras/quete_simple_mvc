<?php

namespace App\Model;
require __DIR__ . '/../../app/db.php';

class ItemManager
{

    public function selectAllItems(): array
    {
        $pdo = new \PDO(DSN, USER, PASS);
        $query = "SELECT * FROM item";
        $res = $pdo->query($query);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectOneItem(int $id) : array
    {
        $pdo = new \PDO(DSN, USER, PASS);
        $query = "SELECT * FROM item WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        // contrairement à fetchAll(), fetch() ne renvoie qu'un seul résultat
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

}
