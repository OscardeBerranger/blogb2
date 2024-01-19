<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Core\Http\Response;

class HomeController extends \Core\Controller\Controller
{

    public function index():Response
    {


        //throw new \Exception("salut je suis ue exception");

        $repo = new ArticleRepository();
        $repo->findAll();
        return $this->render("home/index", [
            "pageTitle"=> "Welcome to the framework"
        ]);
    }




}