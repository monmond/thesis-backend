<?php

declare(strict_types=1);

namespace App\Application\Actions\Monmond;

use App\Application\Utility\DBConnection;
use App\Application\Actions\Action;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;

class ViewMonmondAction extends Action
{

  protected function action(): Response
  {
    $users = $this->execute();
    return $this->respondWithData($users);
  }

  function execute()
  {
    try {
      $userId = (int) $this->resolveArg('id');
      $dbh = new DBConnection();
      $sql = "SELECT * FROM monmond where id = :id";
      $parameters = [
        ":id" => $userId
      ];
      $sth = $dbh->prepare($sql);
      $sth->execute($parameters);
      if ($sth->rowCount() == 0) {
        throw new DomainRecordNotFoundException();
      }
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      $sth = null;
      $dbh = null;
      $this->logger->info("Monmond of id `${userId}` was viewed.");
      return $result;
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
