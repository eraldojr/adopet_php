<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use adopet\Application;
use adopet\Plugins\RoutePlugin;
use adopet\Plugins\ViewPlugin;
use adopet\Plugins\DbPlugin;
use adopet\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);
$app->plugin(new ViewPlugin());
$app->plugin(new RoutePlugin());
$app->plugin(new DbPlugin());
$app->get('/', function() use($app){
    $view = $app->service('viewRenderer');
    return $view->render('pagestemplates/home.html.twig');
}, 'home')
->get('/adote', function() use($app){
    $view = $app->service('viewRenderer');
    return $view->render('pagestemplates/adopt.html.twig');
}, 'adopt')
->get('/sobre', function() use($app){
    $view = $app->service('viewRenderer');
    return $view->render('pagestemplates/about.html.twig');
}, 'about')
->get('/contato', function() use($app){
    $view = $app->service('viewRenderer');
    return $view->render('pagestemplates/contact.html.twig');
}, 'contact')
->start();
