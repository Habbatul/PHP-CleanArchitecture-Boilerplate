<?php
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ini untuk Builder
 */
//untuk inisiasi controller yang berada di containerBuilder (pada folder depedencies.php)
$di = require_once 'dependencies.php';

/**
 * Dibawah ini adalah routing nya
 */
//routing
$routes = new RouteCollection();

/**
 * Ini untuk menyederhanakan controller yang berada pada container
 */
function createRoute($path, $controller, $methodName) {
    $controllerMethod = function (Request $request) use ($controller, $methodName) {
        return $controller->$methodName($request);
    };
    return new Route($path, ['_controller' => $controllerMethod]);
}

/**
 * Contoh bila method static (tidak perlu mendefinisikan hanya perlu include lalu use,
 * lalu panggil seperti contoh) : $routes->add('beranda', new Route('/', ['_controller' => 'Controller\Home::beranda']));
 * Bila memiliki depedency injection pastikan sudah register pada config.php 
 * lalu definisikan container baru gunakan method createRoute($endpoint, $variableController, 'NamaMethod')
 */ 

//routes list
//bila tidak memiliki injection (pada  depedencies.php langsung di new)
$routes->add('beranda', new Route('/', ['_controller' => [$di['home'], 'beranda']]));

//halaman user
$routes->add('about', createRoute('/tentangkami', $di['aboutController'], 'halamanTerserah'));

//Lanjutkan untuk container yang ingin dipanggil

return $routes;
