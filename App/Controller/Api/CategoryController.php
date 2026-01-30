<?php

namespace App\Controller\Api;

use App\Controller\AbstractController;
use App\Service\CategoryService;

class CategoryController extends AbstractController
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function getAllCategories(): mixed
    {
        //Récupération des categories en BDD
        $categories = $this->categoryService->getAllCategories();

        //Response en Json
        return $this->jsonResponse($categories, 200);
    }

    public function addCategory(): mixed
    {
        //Récupération du body
        $json = file_get_contents('php://input');

        //vérifier si on à un a json vide (pas de json)
        if (empty($json) || !json_validate($json)) {
            return $this->jsonResponse(["erreur"=>"vide ou invalide"], 400);
        }

        //convertion en tableau
        $category = json_decode($json, true);

        try {
            $category = $this->categoryService->saveCategory($category);
        } catch(\Exception $e) {
            return $this->jsonResponse(["erreur"=>$e->getMessage()], 400);
        }

        return $this->jsonResponse($category, 201);
    }
}
