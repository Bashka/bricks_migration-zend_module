<?php
namespace Bricks\Migration;

use Bricks\Migration\Controller\MigrationController;
use Bricks\Migration\ServiceManager\Factory\MigrationControllerFactory;
use Bricks\Migration\Manager;
use Bricks\Migration\ServiceManager\Factory\ManagerFactory;
use Bricks\Migration\ServiceManager\PluginManager\LoaderPluginManager;
use Bricks\Migration\ServiceManager\Factory\LoaderPluginManagerFactory;
use Bricks\Migration\Loader\LoaderInterface;
use Bricks\Migration\ServiceManager\Factory\LoaderFactory;

return [
  // Configuration module.
  'migration' => [
    // Path to journal file.
    'journal_path' => '',
    // Migrations loader configuration.
    'loader' => [
      // Loader type.
      'name' => 'glob',
      'options' => [
        'namespace' => '', // Migrations namespace.
        'path' => '', // Path to migrations dir.
        'glob' => '*.php', // Used to search glob-pattern.
      ],
    ],
  ],

  'console' => include(__DIR__ . '/console.config.php'),

  'service_manager' => [
    'factories' => [
      LoaderPluginManager::class => LoaderPluginManagerFactory::class,
      Manager::class => ManagerFactory::class,
      LoaderInterface::class => LoaderFactory::class,
    ],
  ],
  'controllers' => [
    'factories' => [
      MigrationController::class => MigrationControllerFactory::class,
    ],
  ],
];
