<?php
namespace Bricks\Migration;

use Bricks\Migration\Controller\MigrationController;

return [
  'router' => [
    'routes' => [
      'migration-up' => [
        'type' => 'simple',
        'options' => [
          'route' => 'migration up [<target>]',
          'defaults' => [
            'controller' => MigrationController::class,
            'action' => 'up',
          ],
        ],
      ],
      'migration-down' => [
        'type' => 'simple',
        'options' => [
          'route' => 'migration down [<target>]',
          'defaults' => [
            'controller' => MigrationController::class,
            'action' => 'down',
          ],
        ],
      ],
    ],
  ],
];
