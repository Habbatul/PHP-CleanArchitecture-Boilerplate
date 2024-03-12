<?php
use Controller\AuthController;
use Controller\Home;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ini untuk Builder
 */
//untuk inisiasi containerBuilder
use DI\ContainerBuilder;
// Membuat instance ContainerBuilder dan membangun kontainer dependensi
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$container = $containerBuilder->build();

/**
 * instansiasi dulu bila method nya tidak static sperti : $home = new Home();
 * Jangan lupa panggil container yang sudah didefinisikan pada config
 */ 

//container list
$home = new Home();
$authController = $container->get(AuthController::class);
//Lanjutkan untuk container yang ingin dipanggil

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
$routes->add('beranda', new Route('/', ['_controller' => [$home, 'beranda']]));
$routes->add('about', createRoute('/tentangkami', $aboutController, 'halamanTerserah'));

//Lanjutkan untuk container yang ingin dipanggil

return $routes;
