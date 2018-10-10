<?php

namespace App\Model;

class ItemManager
{

    public function selectAllItems(): array
    {
        require __DIR__ . '/../../app/db.php';
        $pdo = new \PDO(DSN, USER, PASS);
        $query = "SELECT * FROM item";
        $res = $pdo->query($query);
        return $res->fetchAll();
    }

}
