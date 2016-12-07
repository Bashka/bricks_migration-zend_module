<?php
namespace Bricks\Migration\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Interop\Container\ContainerInterface;
use Bricks\Migration\SelfDIInterface;
use Bricks\Migration\Loader\LoaderInterface;
use Bricks\Migration\Manager;

/**
 * @author Artur Sh. Mamedbekov
 */
class MigrationController extends AbstractActionController{
  /**
   * @var ContainerInterface Контейнер для инциализации миграций.
   */
  private $container;

  /**
   * @var LoaderInterface Используемый загрузчик миграций.
   */
  private $loader;

  /**
   * @var Manager Используемый менеджер миграций.
   */
  private $manager;

  /**
   * @param LoaderInterface $loader Используемый загрузчик миграций.
   * @param Manager $manager Используемый менеджер миграций.
   */
  public function __construct(ContainerInterface $container, LoaderInterface $loader, Manager $manager){
    $this->container = $container;
    $this->loader = $loader;
    $this->manager = $manager;
  }

  // Actions
  public function upAction(){
    $targetClass = $this->getRequest()->getParam('target', null);
    foreach($this->loader as $migration){
      if(!is_null($targetClass) && get_class($migration) != $targetClass){
        continue;
      }
      if(!$this->manager->isUp($migration)){
        continue;
      }
      echo 'Start up: ' . get_class($migration) . "\n";
      if($migration instanceof SelfDIInterface){
        $migration->init($this->container);
      }
      $this->manager->up($migration);
    }

    return 'done';
  }

  public function downAction(){
    $targetClass = $this->getRequest()->getParam('target', null);
    foreach($this->loader as $migration){
      if(!is_null($targetClass) && get_class($migration) != $targetClass){
        continue;
      }
      if(!$this->manager->isDown($migration)){
        continue;
      }
      echo 'Start down: ' . get_class($migration) . "\n";
      if($migration instanceof SelfDIInterface){
        $migration->init($this->container);
      }
      $this->manager->down($migration);
    }

    return 'done';
  }
}
