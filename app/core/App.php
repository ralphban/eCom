<?php
namespace app\core;

class App{
    
    function __construct(){

        $url = $_GET['url'] ?? '';

        $routes = ['Contact/read'=>'Contact,read',
                    'Contact/index'=>'Contact,contactIndex',
                    'Contact/submitForm' => 'Contact,submitForm',
                    'Main/index'=>'Main,index',
                    'Main/about_us'=>'Main,aboutUs',
                ];

        //one by one compare the url to resolve the route
        foreach ($routes as $routeUrl => $controllerMethod) {
            if ($url == $routeUrl) { // Match the route
                // Run the route
                [$controller, $method] = explode(',', $controllerMethod);
                $controller = '\\app\\controllers\\' . $controller . 'Controller'; // Append 'Controller' to match the filename
                $controller = new $controller();
                $controller->$method();
                // Make sure that we don't run a second route
                break;
            }
        }
    }
}