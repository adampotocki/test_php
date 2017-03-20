<?php

  require_once(dirname(__FILE__) . '/connection.php');

  class Drop {

    public function drop_db() {
      try {
        if ($this->verify_db(DBNAME)) {
          $sql = 'drop database ' . DBNAME . ';';
          $stmt = Connection::get_nodb()->prepare($sql);
          $stmt->execute();
          echo 'Database: "' . DBNAME . '" has been dropped.';
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
        echo 'Database: "' . DBNAME . '" does not exist and can not be dropped.';
        return false;
      }
      return true;
    }

  }

  $obj = new Drop();
  $obj->drop_db();
?>