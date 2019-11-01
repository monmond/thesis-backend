<?php

declare(strict_types=1);

namespace App\Application\Actions\Monmond;

use App\Application\Utility\DBConnection;
use App\Application\Actions\Action;
use Slim\Exception\HttpBadRequestException;
use App\Domain\DomainException\DomainDeleteException;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteMonmondAction extends Action
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
      $sql = "DELETE FROM monmond 
              WHERE name = :name 
              AND age = :age";
      $parameters = [
        ':name' => (string) $parsedBody->name,
        ':age' => (int) $parsedBody->age
      ];
      $sth = $dbh->prepare($sql);
      $sth->execute($parameters);
      if ($sth->rowCount() == 0) {
        throw new DomainDeleteException();
      }
      $result = $sth->rowCount() > 0;
      $sth = null;
      $dbh = null;
      $this->logger->info("Monmond was deleted.");
      return $result;
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
