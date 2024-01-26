<?php

namespace Core\Controller;

use App\Repository\UserRepository;
use Core\Http\Response;
use Core\Http\Serializer;
use Core\Session\Flash;
use Core\Session\Session;
use Core\View\View;

#[Wireable]
abstract class Controller
{
    private Response $response;
    private Serializer $serializer;

    public function __construct()
    {
        $this->response = new Response();
        $this->serializer = new Serializer();
    }

    public function redirect(string $route = null)
    {

        return $this->response->redirect($route);
    }
    public function render($nomDeTemplate, $donnees)
    {
        return $this->response->render($nomDeTemplate, $donnees);
    }
    public function json($toSerialize){
        return $this->serializer->serialize($toSerialize);
    }

    public function addFlash(string $message, string $color = "primary")
    {
        Flash::addMessage($message, $color);
    }

    public function getUser(): object | bool
    {
        if(Session::userConnected())
        {
            $userRepository = new UserRepository();
            return  $userRepository->find(Session::user()['id']);
        }
        return false;

    }

}