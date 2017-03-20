<?php

  require_once(dirname(__FILE__) . '/connection.php');

  class Init {

    public function create_db() {
      try {
        if (!$this->verify_db(DBNAME)) {
          $sql = 'create database ' . DBNAME . ';';
          $stmt = Connection::get_nodb()->prepare($sql);
          $stmt->execute();
          echo 'Database: "' . DBNAME . '" has been created.';
        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }

    private function verify_db($dbname) {
      $sql = 'select datname from pg_database WHERE datname= :dbname';
      $stmt = Connection::get_nodb()->prepare($sql);
      $stmt->bindValue(':dbname', $dbname);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      if (empty($stmt->fetch())) {
        return false;
      }
      echo 'Database: "' . DBNAME . '"; is already created and ready to use.';
      return true;
    }

  }

  $obj = new Init();
  $obj->create_db();
?>