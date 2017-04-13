<?php
declare(strict_types=1);

namespace adopet;

use adopet\Plugins\IPlugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\SapiEmitter;

class Application
{
  private $serviceContainer;

  public function __construct(IServiceContainer $serviceContainer)
  {
    $this->serviceContainer = $serviceContainer;
  }

  public function service($name)
  {
    return $this->serviceContainer->get($name);
  }

  public function addService(string $name, $service): void
  {
    if(is_callable($service)){
      $this->serviceContainer->addLazy($name,$service);
    }else{
      $this->serviceContainer->add($name,$service);
    }
  }

  public function plugin(IPlugin $iplugin): void
  {
    $iplugin->register($this->serviceContainer);
  }

  public function get($path, $action, $name = null)
  {
    $routing = $this->service('routing');
    $routing->get($name, $path, $action);
    return $this;
  }

  public function start()
  {
    $route = $this->service('route');
    /** @var RequestInterface $request  */
    $request = $this->service(RequestInterface::class);
    if(!$route){
      echo "Page not found!";
      exit;
    }
    foreach ($route->attributes as $key => $value){
        $request = $request->withAttribute($key,$value);
    }

    $callable = $route->handler;
    $response = $callable($request);
    $this->emitResponse($response);
  }

  protected function emitResponse(ResponseInterface $response)
  {
    $emitter = new SapiEmitter();
    $emitter->emit($response);

  }
}
