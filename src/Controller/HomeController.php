<?php

namespace App\Controller;

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index(): mixed
    {
        return $this->render("home","Accueil");
    }
}
