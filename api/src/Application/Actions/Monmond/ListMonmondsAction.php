<?php

declare(strict_types=1);

namespace App\Application\Actions\Monmond;

use PDO;
use App\Application\Utility\DBConnection;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class ListMonmondsAction extends Action
{

  protected function action(): Response
  {
    $data = $this->execute();
    return $this->respondWithData($data);
  }

  function execute(): array
  {
    try {
      $dbh = new DBConnection();
      $sql = "SELECT * FROM monmond";
      $parameters = null;
      $sth = $dbh->prepare($sql);
      $sth->execute();
      if (!$sth) {
        throw $sth->errorInfo();
      }
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      $sth = null;
      $dbh = null;
      $this->logger->info("Monmonds list was viewed.");
      return $result;
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
