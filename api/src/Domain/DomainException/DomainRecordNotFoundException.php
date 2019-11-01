<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

class DomainRecordNotFoundException extends DomainException
{
  public $message = 'The date you requested does not exist.';
}
