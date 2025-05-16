<?php
namespace Modules\Site\Models;

use PDO;
use PDOException;

use App\Core\Database;

use App\Core\NewException;

class mCommon extends Database
{
  public function __construct()
  {
    parent::__construct();
  }

  public static function hasTable(string $table): array
  {
    try {
      $query = "SELECT * FROM `$table`";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->execute();

      return array(
        "state" => true,
        "data" => array()
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function hasTableById(string $table, int $id): array
  {
    try {
      $query = "SELECT * FROM `$table` WHERE `id`=:id";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return array(
        "state" => true,
        "data" => array()
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function countTable(string $table): array
  {
    try {
      $query = "SELECT * FROM `$table`";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();


      return array(
        "state" => true,
        "data" => array($stmt->rowCount())
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function countTableById(string $table, int $id): array
  {
    try {
      $query = "SELECT * FROM `$table` WHERE `id`=:id";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return array(
        "state" => true,
        "data" => array($stmt->rowCount())
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function countTableByEmail(string $table, string $email): array
  {
    try {
      $query = "SELECT * FROM `$table` WHERE `email`=:email";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return array(
        "state" => true,
        "data" => array($stmt->rowCount())
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function countTableByName(string $table, string $name): array
  {
    try {
      $query = "SELECT * FROM `$table` WHERE `name`=:name";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->bindValue(':name', $name, PDO::PARAM_STR);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return array(
        "state" => true,
        "data" => array($stmt->rowCount())
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }



  public static function countTableBySlug(string $table, string $slug): array
  {
    try {
      $query = "SELECT * FROM `$table` WHERE `slug`=:slug";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $stmt->execute();
      return array(
        "state" => true,
        "data" => array($stmt->rowCount())
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function readAll(string $table): array
  {
    try {
      $query = "SELECT * FROM `$table` ORDER BY `id` ";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $stmt->execute();

      return array(
        "state" => true,
        "data" => $stmt->fetchAll(),
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function readById(string $table, int $id): array
  {
    try {
      $query = "SELECT * FROM `$table` WHERE `id`=:id LIMIT 1";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $stmt->execute();
      return array(
        "state" => true,
        "data" => $stmt->fetchAll(),
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }

  public static function readBySlug(string $table, string $slug): array
  {
    try {
      $query = "SELECT * FROM `$table` WHERE `slug` = :slug ";
      $dB = static::getdb();
      $stmt = $dB->prepare($query);
      $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);

      $stmt->execute();
      return array(
        "state" => true,
        "data" => $stmt->fetchAll(),
      );
    } catch (PDOException $e) {
      return array(
        "state" => false,
        "data" => array("Server Error", $e->getMessage())
      );
    }
  }



  //END CLASS
}