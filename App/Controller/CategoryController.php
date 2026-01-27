<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Service\CategoryService;

class CategoryController extends AbstractController
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function addCategorie(): mixed
    {
        $data = [];

        if ($this->isFormSubmitted($_POST)) {
            $data["msg"] = $this->categoryService->saveCategory($_POST);
        }

        return $this->render("add_category", "Ajouter une categorie", $data);
    }
}