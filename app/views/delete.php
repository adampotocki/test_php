<?php

  require_once(dirname(__FILE__) . '/../models/student.php');
  require_once(dirname(__FILE__) . '/../controllers/student.php');

  try {
    $id = $_POST['id'];
    $student = new Student();
    $student->setId($id);
    $ctrl = new StudentController();

    if ($ctrl->deleteStudent($student)) {
      $response['success'] = "Student {$id} deleted successfully!";
    } else {
      $response['error'] = "Error deleting the student";
    }

    echo json_encode($response);
  } catch(Exception $e) {
    echo $e->getMessage();
  }

?>