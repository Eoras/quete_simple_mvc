<?php

namespace Model;

class CategoryManager extends AbstractManager
{

    const TABLE = 'category';

    public function __construct(\PDO $pdo)
    {
        parent::__construct(self::TABLE, $pdo);
    }

    public function insert(Category $category): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`) VALUES (:name)");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        } else {
            echo "Error during inserting";
        }
    }

    public function delete(Category $category)
    {
        $q = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
        $q->bindValue(":id", $category->getId(), \PDO::PARAM_INT);
        if ($q->execute()) {
            return true;
        } else {
            echo "Error during inserting";
        }
    }

    public function update(Category $category)
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `name` = :name WHERE id = :id");
        $statement->bindValue('name', $category->getName(), \PDO::PARAM_STR);
        $statement->bindValue('id', $category->getId(), \PDO::PARAM_INT);
        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        } else {
            echo "Error during inserting";
        }
        return false;
    }

}
