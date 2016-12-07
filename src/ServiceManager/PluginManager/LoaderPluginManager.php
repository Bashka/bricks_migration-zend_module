<?php
namespace Bricks\Migration\ServiceManager\PluginManager;

use RuntimeException;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\InvalidServiceException;
use Bricks\Migration\Loader\LoaderInterface;
use Bricks\Migration\Loader\GlobLoader;
use Bricks\Migration\ServiceManager\Factory\GlobLoaderFactory;

class LoaderPluginManager extends AbstractPluginManager{
  /**
   * {@inheritdoc}
   */
  protected $aliases = [
    'glob' => GlobLoader::class,
  ];

  /**
   * {@inheritdoc}
   */
  protected $factories = [
    GlobLoader::class => GlobLoaderFactory::class,

    // v2 normalized FQCNs
    'bricksmigrationloaderglobloader' => GlobLoaderFactory::class,
  ];

  /**
   * {@inheritdoc}
   */
  protected $sharedByDefault = false;

  /**
   * For v3.
   *
   * {@inheritdoc}
   */
  protected $instanceOf = LoaderInterface::class;

  /**
   * For v3.
   *
   * {@inheritdoc}
   */
  public function validate($instance){
    if(!$instance instanceof $this->instanceOf){
      throw new InvalidServiceException(sprintf(
        '%s can only create instances of %s; %s is invalid',
        get_class($this),
        $this->instanceOf,
        (is_object($instance) ? get_class($instance) : gettype($instance))
      ));
    }
  }

  /**
   * For v2.
   *
   * {@inheritdoc}
   */
  public function validatePlugin($plugin){
    try{
      $this->validate($plugin);
    }
    catch(InvalidServiceException $e){
      throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
    }
  }
}
