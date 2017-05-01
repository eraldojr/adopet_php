<?php
declare(strict_types = 1);
namespace adopet\Plugins;
use adopet\Models\CategoryCost;
use adopet\IServiceContainer;
use Interop\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
class DbPlugin implements IPlugin
{
    public function register(IServiceContainer $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__ . '/../../config/db.php';
        $capsule->addConnection($config['development']);
        $capsule->bootEloquent();
    }
}
