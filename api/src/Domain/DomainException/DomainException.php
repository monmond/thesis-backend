<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

use Exception;

abstract class DomainException extends Exception
{
  public $message = 'The requested does not complete.';
}
