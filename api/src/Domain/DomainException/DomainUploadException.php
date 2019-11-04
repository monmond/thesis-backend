<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

class DomainUploadException extends DomainException
{
  public $message = 'The data to upload you requested does not complete.';
}
