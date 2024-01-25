<?php

namespace Core\Kernel;

use App\Repository\ArticleRepository;
use Core\Debugging\Debugger;
use Core\Environment\DotEnv;
use Core\ServiceContainer\ServiceContainer;
use Core\Session\Session;

class Kernel
{

    public static function run()
    {
           Session::start();

            $debugger = new Debugger();
            $debugger->run();





    $type = "home";
    $action = "index";

    if(!empty($_GET['type'])){ $type = $_GET['type']; }
    if(!empty($_GET['action'])){ $action = $_GET['action']; }



    $type = ucfirst($type);
    $controllerName = "App\Controller\\".$type."Controller";

    $controller = new $controllerName();

    $serviceContainer = new ServiceContainer();
    $dependencies = $serviceContainer->resolveMethod($controller, $action);

    //$arguments = $dependencies

        $id = "coucou";
        $arguments = array_merge($dependencies, [$id]);

   // $controller->$action($dependencies);
    call_user_func_array([$controller, $action], $arguments);


    }

}