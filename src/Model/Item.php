<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 02/11/2018
 * Time: 15:13
 */

namespace Model;


class Item
{
    private $id;
    private $title;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): Item
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title):Item
    {
        $this->title = $title;
        return $this;
    }
}