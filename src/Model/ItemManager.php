<?php

namespace Model;

class ItemManager extends AbstractManager
{
    const TABLE = 'item';

    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    public function insert(Item $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        } else {
            echo "Error during inserting";
        }
        return false;
    }

    public function delete(Item $item)
    {
        $q = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
        $q->bindValue(":id", $item->getId(), \PDO::PARAM_INT);
        if ($q->execute()) {
            return true;
        } else {
            echo "Error during inserting";
        }
        return false;
    }

    public function update(Item $item)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id = :id");
        $statement->bindValue('title', $item->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('id', $item->getId(), \PDO::PARAM_INT);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        } else {
            echo "Error during inserting";
        }
        return false;
    }
}
