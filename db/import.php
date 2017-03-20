
<?php

  require(dirname(__FILE__) . '/connection.php');
  require(dirname(__FILE__) . '/../app/models/student.php');
  require(dirname(__FILE__) . '/../app/controllers/student.php');

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

  function import_file($file) {
    try {
      $data = csv_to_array(dirname(__FILE__) . $file);

      foreach ($data as $key => $value) {
        $ctrl = new StudentController();
        $record = new Student();
        $record->setId($value['id']);
        $record->setName($value['name']);
        $record->setDob($value['dob']);
        $record->setActive($value['active']);

        $ctrl->importStudent($record);
      }

      $sql = 'SELECT setval(pg_get_serial_sequence(\'student_table\', \'id\'), MAX(id)) FROM student_table';
      $stmt = Connection::get_db()->prepare($sql);
      $stmt->execute();
    } catch (Exception $e) {
      throw $e;
    }
  }

  import_file('/data.csv');

?>