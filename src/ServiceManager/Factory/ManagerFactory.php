<?php
namespace Bricks\Migration\ServiceManager\Factory;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Bricks\Migration\Manager;

/**
 * @author Artur Sh. Mamedbekov
 */
class ManagerFactory implements FactoryInterface{
  /**
   * {@inheritdoc}
   */
  public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
    $options = $container->get('Configuration');
    $options = $options['migration'];

    return new Manager($options['journal_path']);
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
