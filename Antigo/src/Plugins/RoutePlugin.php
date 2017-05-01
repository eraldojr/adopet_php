<?php
declare(strict_types=1);
namespace adopet\Plugins;

use adopet\IServiceContainer;
use Aura\Router\RouterContainer;
use Zend\Diactoros\ServerRequestFactory;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;

class RoutePlugin implements IPlugin
{
  public function register(IServiceContainer $container){
    $routerContainer = new RouterContainer();

    //Map - Registrar as rotas da aplicação
    $map = $routerContainer->getMap();

    //Matcher - Identifica a rota que está sendo acessada
    $matcher = $routerContainer->getMatcher();

    //Generator - Gera link com base nas rotas registradas
    $generator = $routerContainer->getGenerator();

    //Adicionando serviços ao container de serviços
    $container->add('routing',$map);
    $container->add('routingMatcher',$matcher);
    $container->add('routingGenerator',$generator);
    $request = $this->getRequest();
    $container->add(RequestInterface::class, $request);
    $container->addLazy('route',function(ContainerInterface $container){
      $matcher = $container->get('routingMatcher');
      $request= $container->get(RequestInterface::class);
      return $matcher->match($request);
    });

  }

  protected function getRequest(): RequestInterface
  {
      return ServerRequestFactory::fromGlobals(
          $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
      );
  }
}
