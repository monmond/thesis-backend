<?php

declare(strict_types=1);

namespace App\Application\Actions\Monmond;

use App\Application\Utility\DBConnection;
use App\Application\Actions\Action;
use Slim\Exception\HttpBadRequestException;
use App\Domain\DomainException\DomainTransactionException;
use Psr\Http\Message\ResponseInterface as Response;

class TransactionMonmondAction extends Action
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
      try {
        $dbh->beginTransaction();
        $sql = "UPDATE monmond 
                SET age = :age
                WHERE name = :name";
        $parameters = [
          ':name' => (string) $parsedBody->name,
          ':age' => (int) $parsedBody->age
        ];
        $sth = $dbh->prepare($sql);
        $sth->execute($parameters);
        if ($sth->rowCount() == 0) {
          throw new DomainTransactionException();
        }
        $updateResult = $sth->rowCount() > 0;

        $sql = "INSERT INTO monmond (name,age) 
              VALUES (SELECT CONCAT('monmond',(SELECT MAX(id)+1 FROM monmond)),:age)";
        $parameters = [
          ':age' => 12
        ];
        $sth = $dbh->prepare($sql);
        $sth->execute($parameters);
        if ($sth->rowCount() == 0) {
          // throw new DomainTransactionException();
          throw $sth->errorInfo();
        }
        $insertResult = $sth->rowCount() > 0;

        $insertResult = true;

        $dbh->commit();
        $sth = null;
        $dbh = null;
        $this->logger->info("Monmond was executed.");
        return $updateResult && $insertResult;
      } catch (PDOException $e) {
        $dbh->rollBack();
        throw $e;
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
