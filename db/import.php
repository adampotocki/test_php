<?php

  require_once(dirname(__FILE__) . '/connection.php');
  require_once(dirname(__FILE__) . '/../app/models/student.php');

  DEFINE('TABLE_NAME', 'student_table');

  function csv_to_array($filename = '', $delimiter = ',') {
    if (!file_exists($filename) || !is_readable($filename)) {
      return FALSE;
    }

    $header = ['name', 'dob', 'id', 'active'];
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE) {
      while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
        $data[] = array_combine($header, $row);
      }
      fclose($handle);
    }

    return $data;
  }

  function addStudent($student) {
    try {
      $sql = 'CREATE TABLE IF NOT EXISTS ' . TABLE_NAME . '(
          id SERIAL PRIMARY KEY DEFAULT,
          name CHARACTER VARYING(255) NOT NULL,
          dob DATE NOT NULL,
          active BOOLEAN NOT NULL
        );';
      $stmt = Connection::get_db()->prepare($sql);
      $stmt->execute();

      $sql = 'INSERT INTO ' . TABLE_NAME . ' (id, name, dob, active) VALUES (:id, :name, :dob, :active)';
      $stmt = Connection::get_db()->prepare($sql);
      $stmt->bindValue(':id', $student->getId());
      $stmt->bindValue(':name', $student->getName());
      $stmt->bindValue(':dob', $student->getDob());
      $stmt->bindValue(':active', $student->getActive());
      $stmt->execute();

      $sql = 'SELECT setval(pg_get_serial_sequence(\'student_table\', \'id\'), MAX(id)) FROM student_table';
      $stmt = Connection::get_db()->prepare($sql);
      return $stmt->execute();
     } catch (Exception $e) {
       throw $e;
     }
  }

  $students = csv_to_array(dirname(__FILE__) . '/data.csv');

  foreach ($students as $key => $value) {
    $name = $value['name'];
    $student = new Student();
    $student->setId($value['id']);
    $student->setName($value['name']);
    $student->setDob($value['dob']);
    $student->setActive($value['active']);

    addStudent($student);
  }

  // $sql = 'REINDEX TABLE ' . TABLE_NAME;
  // $stmt = Connection::get_db()->prepare($sql);
  // $stmt->execute();

  echo 'data.csv imported';

