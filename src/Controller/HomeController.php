<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\CartService;
use Core\Database\PDOMySQL;
use Core\Http\Response;


class HomeController extends \Core\Controller\Controller
{

    #[Route("/truc/{id}")]
    public function index()
    {

        $test = "ceci sera sérializé";
        return $this->json($test);
    }




}