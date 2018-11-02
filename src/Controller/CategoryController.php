<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 08/10/2018
 * Time: 19:26
 */

namespace App\Controller;

use App\Model\CategoryManager;

class CategoryController
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment($loader);
    }

    public function index()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategories();

        return $this->twig->render('Category/showAll.html.twig', ['categories' => $categories]);
    }

    public function show(int $id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneCategory($id);

        return $this->twig->render('Category/showOne.html.twig', ['category' => $category]);
    }
}