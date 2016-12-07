<?php
namespace Bricks\Migration\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Migration\Loader\LoaderInterface;
use Bricks\Migration\Manager;
use Bricks\Migration\Controller\MigrationController;

/**
 * @author Artur Sh. Mamedbekov
 */
class MigrationControllerFactory implements FactoryInterface{
  /**
   * {@inheritdoc}
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
    return new MigrationController($container, $container->get(LoaderInterface::class), $container->get(Manager::class));
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
