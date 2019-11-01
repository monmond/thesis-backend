<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

class DomainInsertException extends DomainException
{
  public $message = 'The data to insert you requested does not complete.';
}
