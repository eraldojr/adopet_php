<?php
declare(strict_types=1);
namespace adopet\Plugins;

use adopet\IServiceContainer;
use adopet\View\ViewRenderer;
use Interop\Container\ContainerInterface;


class ViewPlugin implements IPlugin
{
    public function register(IServiceContainer $container)
    {
      $container->addLazy('twig', function (ContainerInterface $container){
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
        $twig = new \Twig_Environment($loader);
        $generator = $container->get('routingGenerator');
        $twig->addFunction(new \Twig_SimpleFunction('route',
          function (string $name, array $params=[]) use ($generator){
          return $generator->generate($name, $params);
        }));
        return $twig;
      });

      $container->addLazy('viewRenderer', function(ContainerInterface $container){
        $twigEnvironment = $container->get('twig');
        return new ViewRenderer($twigEnvironment);
      });
    }
}
