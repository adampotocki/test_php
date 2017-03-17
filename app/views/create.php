<?php

  require_once(dirname(__FILE__) . '/../models/student.php');
  require_once(dirname(__FILE__) . '/../controllers/student.php');

  try {
    $student = new Student();
    $student->setId($_POST['id']);
    $student->setName($_POST['name']);
    $student->setDob($_POST['dob']);
    $student->setActive($_POST['active']);
    $ctrl = new StudentController();

    if ($student->getId() == null) {
      if ($ctrl->addStudent($student)) {
        $response['success'] = 'Student added successfully!';
      }else{
        $response['error'] = 'Error saving the Student';
      }
    } else {
      if ($ctrl->updateStudent($student)) {
        $response['success'] = 'Student updated successfully!';
      } else {
        $response['error'] = 'Error updating the Student';
      }
    }

    echo json_encode($response);
  } catch(Exception $e) {
    echo $e->getMessage();
  }