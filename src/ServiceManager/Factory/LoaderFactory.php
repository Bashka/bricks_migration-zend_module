<?php
namespace Bricks\Migration\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Migration\ServiceManager\PluginManager\LoaderPluginManager;
use Bricks\Migration\Manager;

/**
 * @author Artur Sh. Mamedbekov
 */
class LoaderFactory implements FactoryInterface{
  /**
   * {@inheritdoc}
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
    $options = $container->get('Configuration');
    $options = $options['migration'];
    $loaderOptions = $options['loader'];

    return $container->get(LoaderPluginManager::class)->get($loaderOptions['name'], $loaderOptions['options']);
  }
  
  /**
   * For v2.
   *
   * {@inheritdoc}
   */
  public function createService(ServiceLocatorInterface $container, $name = null, $requestedName = null){
    return $this($container, $requestedName?: ConverterInterface::class, []);
  }
}
