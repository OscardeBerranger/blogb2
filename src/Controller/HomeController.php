<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\CartService;
use Core\Database\PDOMySQL;
use Core\Http\Response;


class HomeController extends \Core\Controller\Controller
{

    #[Route("/test")]
    public function test(){

        // echo json_encode("coucou"); die();

        return $this->json(["truc"=>"test", "truc2"=>123]);
    }





}