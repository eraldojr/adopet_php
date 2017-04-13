<?php
namespace adopet\Plugins;

use adopet\IServiceContainer;

interface IPlugin
{
  public function register(IServiceContainer $container);

}
