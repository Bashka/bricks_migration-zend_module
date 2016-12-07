<?php
namespace Bricks\Migration;

use Interop\Container\ContainerInterface;

/**
 * Миграции, реализующие данный интерфейс, используют контейнер для 
 * самостоятельного внедрения своих зависимостей.
 *
 * @author Artur Sh. Mamedbekov
 */
interface SelfDIInterface{
  /**
   * @param ContainerInterface $container
   */
  public function init(ContainerInterface $container);
}
