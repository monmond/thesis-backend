<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

class DomainUpdateException extends DomainException
{
  public $message = 'The data to update you requested does not complete.';
}
