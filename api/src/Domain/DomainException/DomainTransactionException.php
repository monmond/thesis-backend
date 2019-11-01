<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

class DomainTransactionException extends DomainException
{
  public $message = 'The transaction you requested does not complete.';
}
