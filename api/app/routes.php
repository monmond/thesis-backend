<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Monmond\ListMonmondsAction;
use App\Application\Actions\Monmond\ViewMonmondAction;
use App\Application\Actions\Monmond\InsertMonmondAction;
use App\Application\Actions\Monmond\UpdateMonmondAction;
use App\Application\Actions\Monmond\DeleteMonmondAction;
use App\Application\Actions\Monmond\TransactionMonmondAction;
use App\Application\Actions\Monmond\UploadMonmondAction;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
  $app->get('/', function (Request $request, Response $response) {
    echo "start" . "<br/>";
    echo "end" . "<br/>";
    return $response;
  });

  $app->group('/users', function (Group $group) {
    $group->get('', ListUsersAction::class);
    $group->get('/{id}', ViewUserAction::class);
  });

  $app->group('/monmonds', function (Group $group) {
    $group->get('', ListMonmondsAction::class);
    $group->get('/{id}', ViewMonmondAction::class);
    $group->post('/insert', InsertMonmondAction::class);
    $group->post('/update', UpdateMonmondAction::class);
    $group->post('/delete', DeleteMonmondAction::class);
    $group->post('/transaction', TransactionMonmondAction::class);
    $group->post('/upload', UploadMonmondAction::class);
  });

};
