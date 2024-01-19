<?php

namespace Core\Kernel;

use Core\Debugging\Debugger;
use Core\Environment\DotEnv;
use Core\Session\Session;

class Kernel
{

    public static function run()
    {

            $debugger = new Debugger();
            $debugger->run();




        Session::start();

    $type = "home";
    $action = "index";

    if(!empty($_GET['type'])){ $type = $_GET['type']; }
    if(!empty($_GET['action'])){ $action = $_GET['action']; }



    $type = ucfirst($type);
    $controllerName = "App\Controller\\".$type."Controller";

    $controller = new $controllerName();

    $controller->$action();



    }

}