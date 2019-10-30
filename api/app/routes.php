<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


function logDebug(String $message)
{
  echo "[DEBUG]: " . $message . "<br/>";
}

function logError(String $message)
{
  echo "[ERROR]: " . $message . "<br/>";
}


function getConnection() {
  // $dbhost="127.0.0.1";
  // $dbhost="localhost";
  $dbhost="192.168.64.5";
  $dbport=3306;
  $dbuser="ssankosik";
  $dbpass="1234";
  $dbname="monmond";
  $dbdns="mysql:host=$dbhost;port=$dbport;dbname=$dbname;charset=utf8mb4";
  logDebug("dbhost: " . $dbhost);
  logDebug("dbport: " . $dbport);
  logDebug("dbuser: " . $dbuser);
  logDebug("dbpass: " . $dbpass);
  logDebug("dbname: " . $dbname);
  logDebug("dbdns: " . $dbdns);
  $dbh = new PDO($dbdns, $dbuser, $dbpass);  
  logDebug("dbh");
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $dbh;
}

function otvTest() {
  try {
    $dbhost="10.11.0.212";
    $dbport=8080;
    $dbuser="otvapi_usr";
    $dbpass="y839@KDU";
    $dbname="otv";
    $dbdns="mysql:host=$dbhost;dbname=$dbname";
    logDebug("dbhost: " . $dbhost);
    logDebug("dbport: " . $dbport);
    logDebug("dbuser: " . $dbuser);
    logDebug("dbpass: " . $dbpass);
    logDebug("dbname: " . $dbname);
    logDebug("dbdns: " . $dbdns);
    $dbh = new PDO($dbdns, $dbuser, $dbpass); 
    logDebug("dbh"); 
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CALL tme_iflix_status_n()";
    $sth = $dbh->prepare($sql); 
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    print_r($result);
  } catch (PDOException $e) {
    logError($e->getMessage());
    die();
  }
}

function tmeTest() {
  try {
    $dbhost = "122.155.206.212";
    $dbport=8080;
    $dbuser = "manageotvdb";
    $dbpass = "ZFHVgrkfok@$%212d679mBOHPTSfZDFG";
    $dbname = "TME";
    $dbdns="mysql:host=$dbhost;dbname=$dbname;";
    logDebug("dbhost: " . $dbhost);
    logDebug("dbport: " . $dbport);
    logDebug("dbuser: " . $dbuser);
    logDebug("dbpass: " . $dbpass);
    logDebug("dbname: " . $dbname);
    logDebug("dbdns: " . $dbdns);
    $dbh = new PDO($dbdns, $dbuser, $dbpass); 
    logDebug("dbh"); 
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CALL tme_iflix_status_n()";
    $sth = $dbh->prepare($sql); 
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    print_r($result);
  } catch (PDOException $e) {
    logError($e->getMessage());
    die();
  }
}

function connectionTest() {
  try {
    $dbhost="192.168.64.5";
    $dbport=3306;
    $dbuser="ssankosik";
    $dbpass="1234";
    $dbname="monmond";
    $dbdns="mysql:host=$dbhost;port=$dbport;dbname=$dbname;charset=utf8mb4";
    logDebug("dbhost: " . $dbhost);
    logDebug("dbport: " . $dbport);
    logDebug("dbuser: " . $dbuser);
    logDebug("dbpass: " . $dbpass);
    logDebug("dbname: " . $dbname);
    logDebug("dbdns: " . $dbdns);
    $dbh = new PDO($dbdns, $dbuser, $dbpass);  
    logDebug("dbh");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM monmond";
    $sth = $dbh->prepare($sql); 
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    print_r($result);
  } catch (PDOException $e) {
    logError($e->getMessage());
    die();
  }
}

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        logDebug("start 1");
        connectionTest();
        // tmeTest();
        logDebug("end");
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
