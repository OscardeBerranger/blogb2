<?php

namespace Core\Http;

use Core\Serializer\Serializer;
use Core\View\View;

class Response
{

    public function render($nomDeTemplate, $donnees): static
    {
         View::render($nomDeTemplate, $donnees);
         return $this;
    }

    public function renderError($nomDeTemplate): static
    {
        View::renderError($nomDeTemplate);
        return $this;
    }


    public function redirect(string $route = null)
    {
        if(!$route){
            header("Location: index.php");
            exit;
        }else{
            header("Location: {$route}");

        }
        return $this;

    }

    protected function setHeaders(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Methods: *');
    }

    protected function setHttpResponseCode($code): void
    {
        http_response_code($code);
    }

    public function json($toSerialize): static
    {
        $this->setHeaders();
        Serializer::serialize($toSerialize);
        return $this;
    }
}