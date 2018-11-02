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
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment($loader);
    }

    public function index()
    {
        $itemManager = new ItemManager();
        $items = $itemManager->selectAllItems();

        return $this->twig->render('Item/showAll.html.twig', ['items' => $items]);
    }

    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneItem($id);

        return $this->twig->render('Item/showOne.html.twig', ['item' => $item]);
    }
}