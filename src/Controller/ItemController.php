<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 08/10/2018
 * Time: 19:26
 */

namespace App\Controller;


use App\Model\ItemManager;

class ItemController
{
    public function index()
    {
        $itemManager = new ItemManager();
        $items = $itemManager->selectAllItems();

        require __DIR__ . '/../View/item.php';
    }
}