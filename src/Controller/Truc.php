<?php

namespace App\Controller;

class Truc extends \Core\Controller\Controller
{
    public function index(){
        return $this->render("home/index.html.php");
    }
}