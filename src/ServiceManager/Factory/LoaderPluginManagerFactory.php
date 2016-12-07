<?php
namespace Bricks\Migration\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Migration\ServiceManager\PluginManager\LoaderPluginManager;

/**
 * @author Artur Sh. Mamedbekov
 */
class LoaderPluginManagerFactory implements FactoryInterface{
  /**
   * {@inheritdoc}
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
    return new LoaderPluginManager($container, $options?: []);
  }

  /**
   * For v2.
   *
   * {@inheritdoc}
   */
  public function createService(ServiceLocatorInterface $container, $name = null, $requestedName = null){
    return $this($container, $requestedName?: LoaderPluginManager::class, []);
  }
}
