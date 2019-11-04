<?php

declare(strict_types=1);

namespace App\Application\Actions\Monmond;

use PDO;
use RuntimeException;
use App\Application\Utility\DBConnection;
use App\Application\Actions\Action;
use Slim\Exception\HttpBadRequestException;
use App\Domain\DomainException\DomainUploadException;
use Psr\Http\Message\ResponseInterface as Response;

class UploadMonmondAction extends Action
{

  protected function action(): Response
  {
    $data = $this->execute();
    return $this->respondWithData($data);
  }

  function execute()
  {
    try {
      $directory = __DIR__ . "/../../../../../assets/images/profile";
      $uploadedFiles = $this->request->getUploadedFiles();
      $uploadedFile = $uploadedFiles['profile'];
      if (empty($uploadedFile)) {
        throw new HttpBadRequestException($this->request, 'Invalid input.');
      }
      if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $filename = $this->moveUploadedFile($directory, $uploadedFile);
        $this->logger->info("Monmond was uploaded.");
        return $filename;
      } else {
        throw new RuntimeException('Invalid input.');
      }
    } catch (PDOException $e) {
      throw $e;
    }
  }

  function getErrorDescription($error)
  {
    $message = "";
    switch ($error) {
      case UPLOAD_ERR_OK:
        $message = "There is no error, the file uploaded with success";
        break;
      case UPLOAD_ERR_INI_SIZE:
        $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
        break;
      case UPLOAD_ERR_FORM_SIZE:
        $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
        break;
      case UPLOAD_ERR_PARTIAL:
        $message = "The uploaded file was only partially uploaded";
        break;
      case UPLOAD_ERR_NO_FILE:
        $message = "No file was uploaded";
        break;
      case UPLOAD_ERR_NO_TMP_DIR:
        $message = "Missing a temporary folder";
        break;
      case UPLOAD_ERR_CANT_WRITE:
        $message = "Failed to write file to disk";
        break;
      case UPLOAD_ERR_EXTENSION:
        $message = "A PHP extension stopped the file upload";
        break;
      default:
        $message = "Unknown upload error";
        break;
    }
    return $message;
  }

  function moveUploadedFile($directory, $uploadedFile)
  {
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);
    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    return $filename;
  }
}
