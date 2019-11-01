<?php

declare(strict_types=1);

namespace App\Application\Utility;

use PDO;

class DBConnection extends PDO
{

  protected $db_name = "monmond";
  protected $db_user = "ssankosik";
  protected $db_pass = "1234";
  protected $db_host = "192.168.64.5";
  protected $db_port = 3306;

  // protected $db_name = "otv";
  // protected $db_user = "otvapi_usr";
  // protected $db_pass = "y839@KDU";
  // protected $db_host = "10.11.0.212";
  // protected $db_port = 0;

  // protected $db_name = "TME";
  // protected $db_user = "manageotvdb";
  // protected $db_pass = "ZFHVgrkfok@$%212d679mBOHPTSfZDFG";
  // protected $db_host = "122.155.206.212";
  // protected $db_port = 8080;

  public function __construct()
  {
    try {
      parent::__construct("mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8mb4", $this->db_user, $this->db_pass, array(PDO::ATTR_EMULATE_PREPARES, false, PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $e) {
      throw $e;
    }
  }
  
}
