<?php

  require_once(dirname(__FILE__) . '/../models/student.php');
  require_once(dirname(__FILE__) . '/../controllers/student.php');

  try {
    $student = new Student();
    $student->setId($_POST['id']);
    $ctrl = new StudentController();
    $student = $ctrl->findById($student);

    echo json_encode($student);
  } catch(Exception $e) {
    echo $e->getMessage();
  }