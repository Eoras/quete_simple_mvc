<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 08/10/2018
 * Time: 19:26
 */

namespace Controller;

use Model\Category;
use Model\CategoryManager;

class CategoryController extends AbstractController
{
    public function index()
    {
        $categoryManager = new CategoryManager($this->pdo);
        $categories = $categoryManager->selectAll();

        return $this->twig->render('Category/showAll.html.twig', ['categories' => $categories]);
    }

    public function show(int $id)
    {
        $categoryManager = new CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);

        return $this->twig->render('Category/showOne.html.twig', ['category' => $category]);
    }

    public function add()
    {
        $errors = [];

        if (!empty($_POST)) {
            if (!isset($_POST['name'])) {
                $errors['global'] = 'The input isn\'t good';
            } elseif (strlen($_POST['name']) < 3) {
                $errors['name'] = 'Name must be string with min 3 characters';
            }

            if (count($errors) == 0) {
                // création d'un nouvel objet Item et hydratation avec les données du formulaire
                $category = new Category();
                $category->setName($_POST['name']);

                $categoryManager = new CategoryManager($this->pdo);
                $categoryManager->insert($category);
                header('Location: /categories');
                exit();
            }
        }
        // le formulaire HTML est affiché (vue à créer)
        return $this->twig->render('category/add.html.twig', ['errors' => $errors]);
    }

    public function edit(int $id)
    {
        $editMode = true;
        $categoryManager = new CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);
        $errors = [];

        if (!empty($_POST)) {
            $category->setName($_POST['name']);

            if (!isset($_POST['name'])) {
                $errors['global'] = 'The input isn\'t good';
            } elseif (strlen($_POST['name']) < 3) {
                $errors['name'] = 'Name must be string with min 3 characters';
            }

            if (count($errors) == 0) {
                $category->setName($_POST['name']);
                $categoryManager->update($category);
                header('Location: /category/' . $category->getId());
                exit();
            }
        }
        return $this->twig->render('category/add.html.twig',
            [
                'errors' => $errors,
                'category' => $category,
                'editMode' => $editMode
            ]
        );
    }

    public function delete(int $id)
    {
        $categoryManager = new CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);
        $categoryManager->delete($category);

        header("location: /categories");
        exit();
    }
}
