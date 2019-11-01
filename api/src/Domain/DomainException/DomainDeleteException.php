<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

class DomainDeleteException extends DomainException
{
  public $message = 'The data to delete you requested does not complete.';
}
