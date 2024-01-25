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
    public function index(PDOMySQL $service ):Response
    {


    echo $service->coucou();




      // var_dump($id) ;
      // var_dump($repo);


        return $this->render("home/index", [
            "pageTitle"=> "Welcome to the framework"
        ]);
    }




}