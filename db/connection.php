<?php

  DEFINE('DBHOST', 'localhost');
  DEFINE('DBNAME', 'test');
  DEFINE('DBUSER', 'potockra');
  DEFINE('DBPASS', '');
  DEFINE('DBPORT', '5432');
  DEFINE('TABLE_NAME', 'student_table');

  class Connection extends PDO {
    private static $db;
    private static $nodb;

    public function __construct($dsn, $user, $pass){
      parent::__construct($dsn, $user, $pass);
    }

    public static function get_db() {
      if (!isset(self::$db)) {
        $dsn = 'pgsql:dbname=' . DBNAME . ';host=' . DBHOST . ';port=' . DBPORT;
        self::$db = new Connection($dsn, DBUSER, DBPASS);
      }
      return self::$db;
    }

    public static function get_nodb() {
      if (!isset(self::$nodb)) {
        $dsn = 'pgsql:host=' . DBHOST . ';port=' . DBPORT;
        self::$nodb = new Connection($dsn, DBUSER, DBPASS);
      }
      return self::$nodb;
    }

  }
