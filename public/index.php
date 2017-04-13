<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use adopet\Application;
use adopet\Plugins\RoutePlugin;
use adopet\Plugins\ViewPlugin;
use adopet\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);
$app->plugin(new ViewPlugin());
$app->plugin(new RoutePlugin());
$app->get('/', function(RequestInterface $request) use($app){
    $view = $app->service('viewRenderer');
    return $view->render('test.html.twig', ['name' => 'Eraldo Junior']);
});
$app->get('/{name}', function(ServerRequestInterface $request) use($app){
    $view = $app->service('viewRenderer');
    return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
});
$app->start();
