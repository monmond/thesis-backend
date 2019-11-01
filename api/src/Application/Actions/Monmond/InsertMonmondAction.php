<?php

declare(strict_types=1);

namespace App\Application\Actions\Monmond;

use App\Application\Utility\DBConnection;
use App\Application\Actions\Action;
use Slim\Exception\HttpBadRequestException;
use App\Domain\DomainException\DomainInsertException;
use Psr\Http\Message\ResponseInterface as Response;

class InsertMonmondAction extends Action
{

  protected function action(): Response
  {
    $data = $this->execute();
    return $this->respondWithData($data);
  }

  function execute()
  {
    try {
      $parsedBody = $this->getFormData();
      if (is_null($parsedBody->name) || is_null($parsedBody->age)) {
        throw new HttpBadRequestException($this->request, 'Invalid input.');
      }
      $dbh = new DBConnection();
      $sql = "INSERT INTO monmond (name,age) 
              VALUES (:name,:age)";
      $parameters = [
        ':name' => (string) $parsedBody->name,
        ':age' => (int) $parsedBody->age
      ];
      $sth = $dbh->prepare($sql);
      $sth->execute($parameters);
      if ($sth->rowCount() == 0) {
        throw new DomainInsertException();
      }
      $result = $sth->rowCount() > 0;
      $sth = null;
      $dbh = null;
      $this->logger->info("Monmond was inserted.");
      return $result;
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
