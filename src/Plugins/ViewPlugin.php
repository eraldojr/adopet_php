<?php
declare(strict_types=1);
namespace adopet\Plugins;

use Interop\Container\ContainerInterface;
use adopet\IServiceContainer;
use adopet\View\ViewRenderer;


class ViewPlugin implements IPlugin
{
    public function register(IServiceContainer $container)
    {
      $container->addLazy('twig', function (ContainerInterface $container){
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../Templates');
        $twig = new \Twig_Environment($loader);
        return $twig;
      });

      $container->addLazy('viewRenderer', function(ContainerInterface $container){
        $twigEnvironment = $container->get('twig');
        return new ViewRenderer($twigEnvironment);
      });
    }
}
