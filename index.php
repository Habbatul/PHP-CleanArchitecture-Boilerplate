<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__ . '/app/config/BaseUrl.php';
require_once __DIR__ . '/app/config/IsProduction.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;


$request = Request::createFromGlobals();
$routes = include __DIR__.'/routes.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());
    $controller = $parameters['_controller'];
    $response = call_user_func($controller, $request);
    if ($response !== null) {
        $response->send();
    }
} catch (ResourceNotFoundException $e) {
    $error404Content = file_get_contents('public/error/error404.html');
    $response = new Response($error404Content, Response::HTTP_NOT_FOUND);
    $response->send();
}