<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 08/10/2018
 * Time: 19:26
 */

namespace Controller;

use Model\Item;
use Model\ItemManager;

class ItemController extends AbstractController
{
    public function index()
    {
        $itemManager = new ItemManager($this->pdo);
        $items = $itemManager->selectAll();
        return $this->twig->render('Item/showAll.html.twig', ['items' => $items]);
    }

    public function show(int $id)
    {
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('Item/showOne.html.twig', ['item' => $item]);
    }

    public function add()
    {
        $errors = [];

        if (!empty($_POST)) {
            if (!isset($_POST['title'])) {
                $errors['global'] = 'The input isn\'t good';
            } elseif (strlen($_POST['title']) < 3) {
                $errors['title'] = 'Title must be string with min 3 characters';
            }

            if (count($errors) == 0) {
                // création d'un nouvel objet Item et hydratation avec les données du formulaire
                $item = new Item();
                $item->setTitle($_POST['title']);

                $itemManager = new ItemManager($this->pdo);
                $itemManager->insert($item);
                header('Location: /');
                exit();
            }
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('item/add.html.twig', ['errors' => $errors]);
    }

    public function edit(int $id)
    {
        $editMode = true;
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);
        $errors = [];

        if (!empty($_POST)) {
            $item->setTitle($_POST['title']);

            if (!isset($_POST['title'])) {
                $errors['global'] = 'The input isn\'t good';
            } elseif (strlen($_POST['title']) < 3) {
                $errors['title'] = 'Title must be string with min 3 characters';
            }

            if (count($errors) == 0) {
                $item->setTitle($_POST['title']);
                $itemManager->update($item);
                header('Location: /item/' . $item->getId());
                exit();
            }
        }
        return $this->twig->render('item/add.html.twig',
            [
                'errors' => $errors,
                'item' => $item,
                'editMode' => $editMode
            ]
        );
    }

    public function delete(int $id)
    {
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);
        $itemManager->delete($item);

        header("location: /");
        exit();
    }
}
